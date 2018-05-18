<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\HttpClient;


use FtwSoft\Rundeck\Authentication\AuthenticationInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Exception\GuzzleException;

class Guzzle6HttpClient implements HttpClientInterface
{

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * Guzzle6HttpHandler constructor.
     *
     * @param AuthenticationInterface $auth
     */
    public function __construct(AuthenticationInterface $auth)
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());
        $stack->push(function ($handler) use ($auth) {
            return function (RequestInterface $request, array $options) use ($auth, $handler) {
                return $handler($auth->authenticate($request), $options);
            };
        });

        $this->client = new HttpClient(['handler' => $stack]);
    }

    /**
     * @inheritDoc
     *
     * @throws GuzzleException
     */
    public function request($method, $uri, array $json = [])
    {
        return $this->client->request($method, $uri, [
            'headers'         => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ],
            'connect_timeout' => 10,
            'timeout'         => 10,
            'json'            => $json
        ]);
    }


}