<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\JobExecutionOutput;


class OutputEntryEntity
{

    /**
     * @var string
     */
    private $time;

    /**
     * @var \DateTime
     */
    private $absoluteTime;

    /**
     * @var string
     */
    private $log;

    /**
     * @var string
     */
    private $level;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $stepCtx;

    /**
     * @var string
     */
    private $node;

    /**
     * OutputEntryEntity constructor.
     *
     * @param string    $time
     * @param \DateTime $absoluteTime
     * @param string    $log
     * @param string    $level
     * @param string    $user
     * @param string    $stepCtx
     * @param string    $node
     */
    public function __construct($time, \DateTime $absoluteTime, $log, $level, $user, $stepCtx, $node)
    {
        $this->time = $time;
        $this->absoluteTime = $absoluteTime;
        $this->log = $log;
        $this->level = $level;
        $this->user = $user;
        $this->stepCtx = $stepCtx;
        $this->node = $node;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return \DateTime
     */
    public function getAbsoluteTime()
    {
        return $this->absoluteTime;
    }

    /**
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getStepCtx()
    {
        return $this->stepCtx;
    }

    /**
     * @return string
     */
    public function getNode()
    {
        return $this->node;
    }

}