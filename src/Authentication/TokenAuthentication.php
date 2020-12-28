<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Authentication;

use Psr\Http\Message\RequestInterface;

class TokenAuthentication implements AuthenticationInterface
{
    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function authenticate(RequestInterface $request): RequestInterface
    {
        return $request->withHeader('X-Rundeck-Auth-Token', $this->token);
    }
}
