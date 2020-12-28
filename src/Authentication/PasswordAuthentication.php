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

    public function __construct(
        string $host,
        string $username,
        string $password,
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
     * @throws AuthenticationException
     * @throws ClientExceptionInterface
     */
    public function authenticate(RequestInterface $request): RequestInterface
    {
        if (is_null($this->authenticationCookies)) {
            $this->authenticationCookies = $this->retrieveCookies();
        }

        return $request->withHeader('Cookie', implode('; ', $this->authenticationCookies));
    }

    /**
     * @throws AuthenticationException
     * @throws ClientExceptionInterface
     */
    protected function retrieveCookies(): array
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

        if ($response->getStatusCode() >= 400 || !$response->hasHeader('Set-Cookie')) {
            throw new AuthenticationException('Incorrect credentials');
        }

        // in newer Rundeck versions, we can only detect invalid credentials if it redirects to an error page
        $headerLocation = $response->getHeader('Location');
        if (isset($headerLocation[0]) && false !== strpos($headerLocation[0], 'error')) {
            throw new AuthenticationException('Incorrect credentials');
        }

        return $this->extractCookies($response);
    }

    private function extractCookies(ResponseInterface $response): array
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
