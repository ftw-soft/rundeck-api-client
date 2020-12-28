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
     * @var AuthenticationInterface
     */
    private $authentication;

    public function __construct(
        string $host,
        AuthenticationInterface $authentication,
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        int $apiVersion = 36
    ) {
        $this->baseUrl = rtrim($host, '/') . '/api/' . $apiVersion . '/';
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->authentication = $authentication;
        $this->streamFactory = $streamFactory;
    }

    /**
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function request(string $method, string $function, array $parameters = []): ResponseInterface
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

            $request = $this->authentication->authenticate($request);
            return $this->httpClient->sendRequest($request);
        } catch (Exception $exception) {
            if ($exception instanceof ExceptionResponseInterface && null !== $exception->getResponse()) {
                return $exception->getResponse();
            }

            throw $exception;
        }
    }

    /**
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function get(string $function, array $parameters = []): ResponseInterface
    {
        $uri = $function;
        if (!empty($parameters)) {
            $uri = sprintf('%s?%s', $function, http_build_query($parameters));
        }
        return $this->request('GET', $uri);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function post(string $function, array $parameters = []): ResponseInterface
    {
        return $this->request('POST', $function, $parameters);
    }

    /**
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function delete(string $function, array $parameters = []): ResponseInterface
    {
        return $this->request('DELETE', $function, $parameters);
    }
}
