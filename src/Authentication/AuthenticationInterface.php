<?php

namespace FtwSoft\Rundeck\Authentication;

use Psr\Http\Message\RequestInterface;

interface AuthenticationInterface
{
    public function authenticate(RequestInterface $request): RequestInterface;
}