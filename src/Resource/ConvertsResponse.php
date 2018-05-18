<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\Exception\InsufficientPermissionsException;
use FtwSoft\Rundeck\Exception\InvalidResourceResponseException;
use FtwSoft\Rundeck\Exception\ResourceNotFoundException;
use Psr\Http\Message\ResponseInterface;

trait ConvertsResponse
{

    /**
     * @param ResponseInterface $response
     *
     * @return array
     * @throws InvalidResourceResponseException
     */
    protected function responseToArray(ResponseInterface $response)
    {
        $content = json_decode($response->getBody()->getContents(), true);

        if (!is_array($content) || isset($content['message'])) {
            $message = isset($content['message']) ? $content['message'] : "Server returned unexpected result";

            $statusCode = $response->getStatusCode();

            if (in_array($statusCode, [401, 403])) {
                throw new InsufficientPermissionsException($response, $message, $statusCode);
            } elseif ($statusCode === 404 && isset($content['errorCode'])) {
                throw new ResourceNotFoundException($response, $message, $statusCode);
            } else {
                throw new InvalidResourceResponseException($response, $message, $statusCode);
            }
        }

        return $content;
    }
}