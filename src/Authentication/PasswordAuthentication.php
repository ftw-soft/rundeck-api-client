<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Authentication;


use FtwSoft\Rundeck\Exception\AuthenticationException;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\CookieJarInterface;
use Psr\Http\Message\RequestInterface;

class PasswordAuthentication implements AuthenticationInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var CookieJarInterface|null
     */
    private $cookie = null;

    /**
     * PasswordAuthentication constructor.
     *
     * @param string $host
     * @param string $username
     * @param string $password
     */
    public function __construct($host, $username, $password)
    {
        $this->host = rtrim($host, '/');
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @inheritDoc
     *
     * @throws AuthenticationException
     */
    public function authenticate(RequestInterface $request)
    {
        if (is_null($this->cookie)) {
            $this->cookie = $this->retrieveCookie();
        }

        return $this->cookie->withCookieHeader($request);
    }

    /**
     * @return CookieJarInterface
     * @throws AuthenticationException
     */
    protected function retrieveCookie()
    {
        $client = new GuzzleHttpClient(['cookies' => true]);

        $jar = new CookieJar();

        $response = $client->post(
            $this->host . '/j_security_check',
            [
                'cookies' => $jar,

                'form_params' => [
                    'j_username' => $this->username,
                    'j_password' => $this->password
                ]
            ]
        );

        if ($response->getStatusCode() === 200) {
            return $jar;
        } else {
            throw new AuthenticationException("Incorrect credentials");
        }
    }


}