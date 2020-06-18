<?php
/**
 * Created by PhpStorm.
 * User: android991
 * Date: 14.02.18
 * Time: 15:44
 */

namespace FtwSoft\Rundeck;

use Exception;
use FtwSoft\Rundeck\HttpClient\HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private $baseUrl;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * Client constructor.
     *
     * @param string              $host
     * @param HttpClientInterface $httpClient
     * @param int                 $apiVersion
     */
    public function __construct(
        $host,
        HttpClientInterface $httpClient,
        $apiVersion = 21
    ) {
        $this->baseUrl = rtrim($host, '/') . '/api/' . $apiVersion . '/';
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $method
     * @param string $function
     * @param array  $parameters
     *
     * @return ResponseInterface
     * @throws Exception
     */
    public function request($method, $function, array $parameters = [])
    {
        try {
            $response = $this->httpClient->request(
                $method,
                $this->baseUrl . rtrim($function, '/'),
                $parameters
            );
        } catch (Exception $exception) {
            if (method_exists($exception, 'getResponse')) {
                return $exception->getResponse();
            }

            throw $exception;
        }

        return $response;
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
        if ([] !== $parameters) {
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
