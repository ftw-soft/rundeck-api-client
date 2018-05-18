<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class TimestampEntity
{

    /**
     * @var int
     */
    private $epoch;

    /**
     * @var string
     */
    private $unit;

    /**
     * @var \DateTime
     */
    private $datetime;

    /**
     * TimestampEntity constructor.
     *
     * @param int       $epoch
     * @param string    $unit
     * @param \DateTime $datetime
     */
    public function __construct($epoch, $unit, \DateTime $datetime)
    {
        $this->epoch = $epoch;
        $this->unit = $unit;
        $this->datetime = $datetime;
    }

    /**
     * @return int
     */
    public function getEpoch()
    {
        return $this->epoch;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

}