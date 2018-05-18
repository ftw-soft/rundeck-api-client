<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class MemoryEntity
{

    /**
     * @var string
     */
    private $unit;

    /**
     * @var int
     */
    private $max;

    /**
     * @var int
     */
    private $free;

    /**
     * @var int
     */
    private $total;

    /**
     * MemoryEntity constructor.
     *
     * @param string $unit
     * @param int    $max
     * @param int    $free
     * @param int    $total
     */
    public function __construct($unit, $max, $free, $total)
    {
        $this->unit = $unit;
        $this->max = $max;
        $this->free = $free;
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return int
     */
    public function getFree()
    {
        return $this->free;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

}