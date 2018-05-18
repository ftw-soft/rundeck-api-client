<?php
namespace FtwSoft\Rundeck\Authentication;

use Psr\Http\Message\RequestInterface;

interface AuthenticationInterface
{

    /**
     * @param RequestInterface $request
     *
     * @return mixed
     */
    public function authenticate(RequestInterface $request);
    
}