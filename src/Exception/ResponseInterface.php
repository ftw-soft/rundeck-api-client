<?php

namespace FtwSoft\Rundeck\Exception;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseInterface
{
    /**
     * @return PsrResponseInterface|null
     */
    public function getResponse();
}
