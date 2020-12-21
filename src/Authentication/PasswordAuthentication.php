<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Authentication;


use FtwSoft\Rundeck\Exception\AuthenticationException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class PasswordAuthentication implements AuthenticationInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var ClientInterface
     */
    private $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string[]|null
     */
    private $authenticationCookies = null;

    /**
     * PasswordAuthentication constructor.
     * @param string $host
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @param string $username
     * @param string $password
     */
    public function __construct(
        $host,
        $username,
        $password,
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->host = rtrim($host, '/');
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     * @throws AuthenticationException
     * @throws ClientExceptionInterface
     */
    public function authenticate(RequestInterface $request)
    {
        if (is_null($this->authenticationCookies)) {
            $this->authenticationCookies = $this->retrieveCookies();
        }

        return $request->withHeader('Cookie', implode('; ', $this->authenticationCookies));
    }

    /**
     * @return string[]
     * @throws AuthenticationException
     * @throws ClientExceptionInterface
     */
    protected function retrieveCookies()
    {
        $request = $this->requestFactory
            ->createRequest('POST', $this->host . '/j_security_check')
            ->withHeader('Content-Type', 'application/x-www-form-urlencoded')
            ->withBody(
                $this->streamFactory->createStream(http_build_query([
                    'j_username' => $this->username,
                    'j_password' => $this->password
                ]))
            );

        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() < 400 && $response->hasHeader('Set-Cookie')) {
            return $this->extractCookies($response);
        } else {
            throw new AuthenticationException('Incorrect credentials');
        }
    }

    /**
     * @param ResponseInterface $response
     * @return string[]
     */
    private function extractCookies(ResponseInterface $response)
    {
        $cookies = [];
        foreach ((array) $response->getHeader('Set-Cookie') as $cookie) {
            if (!preg_match('/^(\w+)=([^;]*)/', $cookie, $matches)) {
                continue;
            }

            $cookies[] = $matches[0];
        }

        return $cookies;
    }
}
