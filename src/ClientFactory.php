<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck;


use FtwSoft\Rundeck\Authentication\PasswordAuthentication;
use FtwSoft\Rundeck\Authentication\TokenAuthentication;
use FtwSoft\Rundeck\HttpClient\Guzzle6HttpClient;

class ClientFactory
{

    /**
     * @param string      $host            Rundeck host
     * @param string      $tokenOrUsername API token or Rundeck's user name
     * @param string|null $password        Use if you want a password authentication
     * @param array       $guzzleConfig    Custom Guzzle config
     *
     * @return Client
     */
    public static function createClient($host, $tokenOrUsername, $password = null, array $guzzleConfig = [])
    {
        if ($password) {
            $auth = new PasswordAuthentication($host, $tokenOrUsername, $password);
        } else {
            $auth = new TokenAuthentication($tokenOrUsername);
        }

        $httpClient = new Guzzle6HttpClient($auth, $guzzleConfig);

        return new Client($host, $httpClient);
    }

}
