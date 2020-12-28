<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Exception;

use FtwSoft\Rundeck\Exception\ResponseInterface as ExceptionResponseInterface;
use Psr\Http\Message\ResponseInterface;

class InvalidResourceResponseException extends \Exception implements ExceptionResponseInterface
{
    /**
     * @var ResponseInterface|null
     */
    private $response;

    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    public function __construct(
        ResponseInterface $response = null,
        string $message = "",
        int $code = 0,
        \Exception $previous = null
    ) {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }
}
