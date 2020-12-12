<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Exception;


use Psr\Http\Message\ResponseInterface;

class InvalidResourceResponseException extends \Exception
{

    /**
     * @var ResponseInterface|null
     */
    private $response;

    /**
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * JobExecutionException constructor.
     *
     * @param ResponseInterface|null $response
     * @param string                 $message
     * @param int                    $code
     * @param \Exception|null        $previous
     */
    public function __construct(ResponseInterface $response = null, $message = "", $code = 0, \Exception $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }
    
}