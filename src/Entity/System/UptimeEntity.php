<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class UptimeEntity
{

    /**
     * @var int
     */
    private $duration;

    /**
     * @var string
     */
    private $unit;

    /**
     * @var TimestampEntity
     */
    private $since;

    /**
     * UptimeEntity constructor.
     *
     * @param int             $duration
     * @param string          $unit
     * @param TimestampEntity $since
     */
    public function __construct($duration, $unit, TimestampEntity $since)
    {
        $this->duration = $duration;
        $this->unit = $unit;
        $this->since = $since;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return TimestampEntity
     */
    public function getSince()
    {
        return $this->since;
    }

}