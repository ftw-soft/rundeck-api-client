<?php
/**
 * Created by PhpStorm.
 * User: android991
 * Date: 14.02.18
 * Time: 15:44
 */

namespace FtwSoft\Rundeck;

use FtwSoft\Rundeck\HttpClient\HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{

    /**
     * @var string
     */
    private $host;

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
     * @param array               $clientConfig
     */
    public function __construct(
        $host,
        HttpClientInterface $httpClient,
        $apiVersion = 21,
        array $clientConfig = []
    )
    {
        $this->host = rtrim($host, '/');

        $this->baseUrl = $this->host . '/api/' . $apiVersion . '/';

        $this->httpClient = $httpClient;
    }

    /**
     * @param string $method
     * @param string $function
     * @param array  $parameters
     *
     * @return ResponseInterface
     * @throws \Exception
     */
    public function request($method, $function, array $parameters = [])
    {
        try {
            $response = $this->httpClient->request(
                $method,
                $this->baseUrl . rtrim($function, '/'),
                $parameters
            );
        } catch (\Exception $exception) {
            if (method_exists($exception, 'getResponse')) {
                $response = $exception->getResponse();
            }

            if (!isset($response)) {
                throw $exception;
            }
        }

        return $response;
    }

    /**
     * @param string $function
     *
     * @return ResponseInterface
     * @throws \Exception
     */
    public function get($function)
    {
        return $this->request('GET', $function);
    }

    /**
     * @param string $function
     * @param array  $parameters
     *
     * @return ResponseInterface
     * @throws \Exception
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
     * @throws \Exception
     */
    public function delete($function, array $parameters = [])
    {
        return $this->request('DELETE', $function, $parameters);
    }

}