<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class SystemEntity
{

    /**
     * @var TimestampEntity
     */
    private $timestamp;

    /**
     * @var RundeckEntity
     */
    private $rundeck;

    /**
     * @var ExecutionsEntity
     */
    private $executions;

    /**
     * @var OsEntity
     */
    private $os;

    /**
     * @var JvmEntity
     */
    private $jvm;

    /**
     * @var StatsEntity
     */
    private $stats;

    /**
     * @var AdditionalInfoEntity[]
     */
    private $additionalInfo;

    /**
     * SystemEntity constructor.
     *
     * @param TimestampEntity        $timestamp
     * @param RundeckEntity          $rundeck
     * @param ExecutionsEntity       $executions
     * @param OsEntity               $os
     * @param JvmEntity              $jvm
     * @param StatsEntity            $stats
     * @param AdditionalInfoEntity[] $additionalInfo
     */
    public function __construct(
        TimestampEntity $timestamp,
        RundeckEntity $rundeck,
        ExecutionsEntity $executions,
        OsEntity $os,
        JvmEntity $jvm,
        StatsEntity $stats,
        array $additionalInfo
    )
    {
        $this->timestamp = $timestamp;
        $this->rundeck = $rundeck;
        $this->executions = $executions;
        $this->os = $os;
        $this->jvm = $jvm;
        $this->stats = $stats;
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @return TimestampEntity
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return RundeckEntity
     */
    public function getRundeck()
    {
        return $this->rundeck;
    }

    /**
     * @return ExecutionsEntity
     */
    public function getExecutions()
    {
        return $this->executions;
    }

    /**
     * @return OsEntity
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * @return JvmEntity
     */
    public function getJvm()
    {
        return $this->jvm;
    }

    /**
     * @return StatsEntity
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @return AdditionalInfoEntity[]
     */
    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

}