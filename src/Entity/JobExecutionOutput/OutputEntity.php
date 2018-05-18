<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\JobExecutionOutput;


class OutputEntity
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var int
     */
    private $offset;

    /**
     * @var bool
     */
    private $completed;

    /**
     * @var bool
     */
    private $execCompleted;

    /**
     * @var bool
     */
    private $hasFailedNodes;

    /**
     * @var string
     */
    private $execState;

    /**
     * @var int
     */
    private $lastModified;

    /**
     * @var int
     */
    private $execDuration;

    /**
     * @var float
     */
    private $percentLoaded;

    /**
     * @var int
     */
    private $totalSize;

    /**
     * @var int
     */
    private $retryBackoff;

    /**
     * @var bool
     */
    private $clusterExec;

    /**
     * @var bool
     */
    private $compacted;

    /**
     * @var OutputEntryEntity[]
     */
    private $entries;

    /**
     * OutputEntity constructor.
     *
     * @param string              $id
     * @param int                 $offset
     * @param bool                $completed
     * @param bool                $execCompleted
     * @param bool                $hasFailedNodes
     * @param string              $execState
     * @param int                 $lastModified
     * @param int                 $execDuration
     * @param float               $percentLoaded
     * @param int                 $totalSize
     * @param int                 $retryBackoff
     * @param bool                $clisterExec
     * @param bool                $compacted
     * @param OutputEntryEntity[] $entries
     */
    public function __construct(
        $id,
        $offset,
        $completed,
        $execCompleted,
        $hasFailedNodes,
        $execState,
        $lastModified,
        $execDuration,
        $percentLoaded,
        $totalSize,
        $retryBackoff,
        $clisterExec,
        $compacted,
        array $entries
    )
    {
        $this->id = $id;
        $this->offset = intval($offset);
        $this->completed = boolval($completed);
        $this->execCompleted = boolval($execCompleted);
        $this->hasFailedNodes = boolval($hasFailedNodes);
        $this->execState = $execState;
        $this->lastModified = $lastModified;
        $this->execDuration = $execDuration;
        $this->percentLoaded = $percentLoaded;
        $this->totalSize = $totalSize;
        $this->retryBackoff = $retryBackoff;
        $this->clusterExec = boolval($clisterExec);
        $this->compacted = boolval($compacted);
        $this->entries = $entries;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    /**
     * @return bool
     */
    public function isExecCompleted()
    {
        return $this->execCompleted;
    }

    /**
     * @return bool
     */
    public function isHasFailedNodes()
    {
        return $this->hasFailedNodes;
    }

    /**
     * @return string
     */
    public function getExecState()
    {
        return $this->execState;
    }

    /**
     * @return int
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * @return int
     */
    public function getExecDuration()
    {
        return $this->execDuration;
    }

    /**
     * @return float
     */
    public function getPercentLoaded()
    {
        return $this->percentLoaded;
    }

    /**
     * @return int
     */
    public function getTotalSize()
    {
        return $this->totalSize;
    }

    /**
     * @return int
     */
    public function getRetryBackoff()
    {
        return $this->retryBackoff;
    }

    /**
     * @return bool
     */
    public function isClusterExec()
    {
        return $this->clusterExec;
    }

    /**
     * @return bool
     */
    public function isCompacted()
    {
        return $this->compacted;
    }

    /**
     * @return OutputEntryEntity[]
     */
    public function getEntries()
    {
        return $this->entries;
    }

}