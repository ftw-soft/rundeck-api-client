<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class StatsEntity
{

    /**
     * @var UptimeEntity
     */
    private $uptime;

    /**
     * @var CpuEntity
     */
    private $cpu;

    /**
     * @var MemoryEntity
     */
    private $memory;

    /**
     * @var SchedulerEntity
     */
    private $scheduler;

    /**
     * @var ThreadsEntity
     */
    private $threads;

    public function __construct(
        UptimeEntity $uptime,
        CpuEntity $cpu,
        MemoryEntity $memory,
        SchedulerEntity $scheduler,
        ThreadsEntity $threads
    )
    {
        $this->uptime = $uptime;
        $this->cpu = $cpu;
        $this->memory = $memory;
        $this->scheduler = $scheduler;
        $this->threads = $threads;
    }

    /**
     * @return UptimeEntity
     */
    public function getUptime()
    {
        return $this->uptime;
    }

    /**
     * @return CpuEntity
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * @return MemoryEntity
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @return SchedulerEntity
     */
    public function getScheduler()
    {
        return $this->scheduler;
    }

    /**
     * @return ThreadsEntity
     */
    public function getThreads()
    {
        return $this->threads;
    }

}