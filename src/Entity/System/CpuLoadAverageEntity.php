<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class CpuLoadAverageEntity
{

    /**
     * @var string
     */
    private $unit;

    /**
     * @var float
     */
    private $average;

    /**
     * CpuLoadAverageEntity constructor.
     *
     * @param string $unit
     * @param float  $average
     */
    public function __construct($unit, $average)
    {
        $this->unit = $unit;
        $this->average = $average;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return float
     */
    public function getAverage()
    {
        return $this->average;
    }

}