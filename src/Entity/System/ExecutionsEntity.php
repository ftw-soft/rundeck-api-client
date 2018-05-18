<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class ExecutionsEntity
{

    /**
     * @var bool
     */
    private $active;

    /**
     * @var string
     */
    private $executionMode;

    /**
     * ExecutionsEntity constructor.
     *
     * @param bool   $active
     * @param string $executionMode
     */
    public function __construct($active, $executionMode)
    {
        $this->active = $active;
        $this->executionMode = $executionMode;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function getExecutionMode()
    {
        return $this->executionMode;
    }

}