<?php

namespace FtwSoft\Rundeck\Exception;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

interface ResponseInterface
{
    public function getResponse(): ?PsrResponseInterface;
}
