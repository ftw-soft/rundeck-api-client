<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity;


class JobExecutionEntity
{
    const STATE_RUNNING = 'running';
    
    const STATE_SUCCEEDED = 'succeeded';

    const STATE_FAILED = 'failed';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $permalink;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $customStatus;

    /**
     * @var string
     */
    private $project;

    /**
     * @var string
     */
    private $executionType;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $serverUUID;


    /**
     * @var \DateTime|null
     */
    private $dateStarted;

    /**
     * @var \DateTime|null
     */
    private $dateEnded;

    /**
     * @var JobEntity
     */
    private $job;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $argString;

    /**
     * @var array
     */
    private $successfulNodes;

    /**
     * @var array
     */
    private $failedNodes;

    /**
     * JobExecutionEntity constructor.
     *
     * @param string $id
     * @param string $href
     * @param string $permalink
     * @param string $status
     * @param string $customStatus
     * @param string $project
     * @param string $executionType
     * @param string $user
     * @param string $serverUUID
     * @param \DateTime $dateStarted
     * @param \DateTime $dateEnded
     * @param JobEntity $job
     * @param string $description
     * @param string $argString
     * @param array $successfulNodes
     */
    public function __construct(
        $id,
        $href,
        $permalink,
        $status,
        $customStatus,
        $project,
        $executionType,
        $user,
        $serverUUID,
        \DateTime $dateStarted = null,
        \DateTime $dateEnded = null,
        JobEntity $job,
        $description,
        $argString,
        array $successfulNodes,
        array $failedNodes
    )
    {
        $this->id = $id;
        $this->href = $href;
        $this->permalink = $permalink;
        $this->status = $status;
        $this->customStatus = $customStatus;
        $this->project = $project;
        $this->executionType = $executionType;
        $this->user = $user;
        $this->serverUUID = $serverUUID;
        $this->dateStarted = $dateStarted;
        $this->dateEnded = $dateEnded;
        $this->job = $job;
        $this->description = $description;
        $this->argString = $argString;
        $this->successfulNodes = $successfulNodes;
        $this->failedNodes = $failedNodes;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCustomStatus()
    {
        return $this->customStatus;
    }

    /**
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return string
     */
    public function getExecutionType()
    {
        return $this->executionType;
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
    public function getServerUUID()
    {
        return $this->serverUUID;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateStarted()
    {
        return $this->dateStarted;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateEnded()
    {
        return $this->dateEnded;
    }

    /**
     * @return JobEntity
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getArgString()
    {
        return $this->argString;
    }

    /**
     * @return array
     */
    public function getSuccessfulNodes()
    {
        return $this->successfulNodes;
    }

    /**
     * @return array
     */
    public function getFailedNodes()
    {
        return $this->failedNodes;
    }

}