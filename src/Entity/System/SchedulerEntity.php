<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class SchedulerEntity
{

    /**
     * @var int
     */
    private $running;

    /**
     * @var int
     */
    private $threadPoolSize;

    /**
     * SchedulerEntity constructor.
     *
     * @param int $running
     * @param int $threadPoolSize
     */
    public function __construct($running, $threadPoolSize)
    {
        $this->running = $running;
        $this->threadPoolSize = $threadPoolSize;
    }

    /**
     * @return int
     */
    public function getRunning()
    {
        return $this->running;
    }

    /**
     * @return int
     */
    public function getThreadPoolSize()
    {
        return $this->threadPoolSize;
    }

}