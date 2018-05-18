<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\HttpClient;


interface HttpClientInterface
{

    /**
     * @param string $method
     * @param string $uri
     * @param array  $json
     *
     * @return mixed
     */
    public function request($method, $uri, array $json = []);

}