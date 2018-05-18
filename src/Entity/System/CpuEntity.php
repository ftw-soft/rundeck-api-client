<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class CpuEntity
{

    /**
     * @var CpuLoadAverageEntity
     */
    private $loadAverage;

    /**
     * @var int
     */
    private $processors;

    /**
     * CpuEntity constructor.
     *
     * @param CpuLoadAverageEntity $loadAverage
     * @param int                  $processors
     */
    public function __construct(CpuLoadAverageEntity $loadAverage, $processors)
    {
        $this->loadAverage = $loadAverage;
        $this->processors = $processors;
    }

    /**
     * @return CpuLoadAverageEntity
     */
    public function getLoadAverage()
    {
        return $this->loadAverage;
    }

    /**
     * @return int
     */
    public function getProcessors()
    {
        return $this->processors;
    }

}