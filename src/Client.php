<?php

namespace FtwSoft\Rundeck;

use Exception;
use FtwSoft\Rundeck\Authentication\AuthenticationInterface;
use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use FtwSoft\Rundeck\Exception\ResponseInterface as ExceptionResponseInterface;

class Client
{
    /**
     * @var string
     */
    private $baseUrl;

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
     * @var AuthenticationInterface|null
     */
    private $authentication = null;

    /**
     * Client constructor.
     *
     * @param string $host
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     * @param StreamFactoryInterface $streamFactory
     * @param int $apiVersion
     */
    public function __construct(
        $host,
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        $apiVersion = 21
    ) {
        $this->baseUrl = rtrim($host, '/') . '/api/' . $apiVersion . '/';
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @param AuthenticationInterface $authentication
     * @return $this
     */
    public function setAuthentication(AuthenticationInterface $authentication)
    {
        $this->authentication = $authentication;
        return $this;
    }

    /**
     * @param string $method
     * @param string $function
     * @param array $parameters
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     */
    public function request($method, $function, array $parameters = [])
    {
        try {
            $request = $this->requestFactory
                ->createRequest($method, $this->baseUrl . rtrim($function, '/'))
                ->withHeader('Accept', 'application/json');

            if (!empty($parameters)) {
                $body = json_encode($parameters);
                if (false === $body) {
                    throw new InvalidArgumentException(
                        'Request parameters could not be converted to json: ' . json_last_error_msg()
                    );
                }

                $request = $request
                    ->withBody($this->streamFactory->createStream($body))
                    ->withHeader('Content-Type', 'application/json');
            }

            if (null !== $this->authentication) {
                $request = $this->authentication->authenticate($request);
            }

            return $this->httpClient->sendRequest($request);
        } catch (Exception $exception) {
            if ($exception instanceof ExceptionResponseInterface && null !== $exception->getResponse()) {
                return $exception->getResponse();
            }

            throw $exception;
        }
    }

    /**
     * @param string $function
     * @param array  $parameters
     *
     * @return ResponseInterface
     * @throws Exception
     */
    public function get($function, array $parameters = [])
    {
        $uri = $function;
        if (!empty($parameters)) {
            $uri = sprintf('%s?%s', $function, http_build_query($parameters));
        }
        return $this->request('GET', $uri);
    }

    /**
     * @param string $function
     * @param array  $parameters
     *
     * @return ResponseInterface
     * @throws Exception
     */
    public function post($function, array $parameters = [])
    {
        return $this->request('POST', $function, $parameters);
    }

    /**
     * @param string $function
     * @param array  $parameters
     *
     * @return ResponseInterface
     * @throws Exception
     */
    public function delete($function, array $parameters = [])
    {
        return $this->request('DELETE', $function, $parameters);
    }

}
