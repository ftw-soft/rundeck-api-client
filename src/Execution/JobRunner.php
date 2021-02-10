<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Execution;

use FtwSoft\Rundeck\Client;
use FtwSoft\Rundeck\Entity\JobExecutionEntity;
use FtwSoft\Rundeck\Entity\JobExecutionOutput\OutputEntity;
use FtwSoft\Rundeck\Exception\JobExecutionAttemptsLimitExceededException;
use FtwSoft\Rundeck\Exception\JobExecutionTimeoutExceededException;
use FtwSoft\Rundeck\Resource\Execution as ExecutionResource;

class JobRunner
{
    /**
     * @var JobExecutionEntity
     */
    private $execution;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var callable|null
     */
    private $onJobStart;

    /**
     * @var callable|null
     */
    private $onJobProgress;

    /**
     * @var callable|null
     */
    private $onJobFinish;

    /**
     * @var callable|null
     */
    private $onJobFailed;

    /**
     * @var int in ms
     */
    private $timeoutBetweenRequests;

    /**
     * @var int in seconds
     */
    private $executionTimeout;

    /**
     * @var int
     */
    private $maxFailedAttemptsInARow;

    /**
     * @var array
     */
    private $log;

    /**
     * @var OutputEntity
     */
    private $output;

    /**
     * JobRunner constructor.
     *
     * @param JobExecutionEntity $execution
     * @param Client             $client
     * @param int                $timeoutBetweenRequests
     * @param int                $executionTimeout
     * @param int                $maxFailedAttemptsInARow
     * @param callable|null      $onJobStart
     * @param callable|null      $onJobProgress
     * @param callable|null      $onJobFinish
     * @param callable|null      $onJobFailed
     */
    public function __construct(
        JobExecutionEntity $execution,
        Client $client,
        $timeoutBetweenRequests = 100,
        $executionTimeout = PHP_INT_MAX,
        $maxFailedAttemptsInARow = 10,
        callable $onJobStart = null,
        callable $onJobProgress = null,
        callable $onJobFinish = null,
        callable $onJobFailed = null
    )
    {
        $this->execution = $execution;
        $this->client = $client;
        $this->timeoutBetweenRequests = $timeoutBetweenRequests;
        $this->executionTimeout = $executionTimeout;
        $this->maxFailedAttemptsInARow = $maxFailedAttemptsInARow;
        $this->onJobStart = $onJobStart;
        $this->onJobProgress = $onJobProgress;
        $this->onJobFinish = $onJobFinish;
        $this->onJobFailed = $onJobFailed;
    }

    /**
     * @param bool $generateOutput
     *
     * @return JobExecutionEntity
     * @throws JobExecutionAttemptsLimitExceededException
     * @throws JobExecutionTimeoutExceededException
     */
    public function wait($generateOutput = false)
    {
        $this->log = [];
        
        $attempts = $this->maxFailedAttemptsInARow;

        $sleep = false;

        $start = microtime(true);
        $executionTime = 0;

        $resource = new ExecutionResource($this->client);

        $this->onJobStartEvent($this->execution);

        $averageDuration = max(ceil($this->execution->getJob()->getAverageDuration() / 1000), 1);

        while (
            $this->execution->getStatus() === JobExecutionEntity::STATE_RUNNING
            || $this->execution->getStatus() === JobExecutionEntity::STATE_SCHEDULED
        ) {
            if ($executionTime > $this->executionTimeout) {
                $exception = new JobExecutionTimeoutExceededException(
                    "The maximum job execution timeout of {$this->executionTimeout} seconds have been exceeded"
                );
                $this->onJobFailedEvent($this->execution, $exception);

                throw $exception;
            }

            if ($sleep) {
                usleep($this->timeoutBetweenRequests);
            }

            try {
                $execution = $resource->get($this->execution->getId());

                $this->execution = $execution;
            } catch (\Exception $e) {
                if (--$attempts === 0) {
                    $exception = new JobExecutionAttemptsLimitExceededException(
                        "The maximum attempts of {$this->maxFailedAttemptsInARow} have been exceeded",
                        0,
                        $e
                    );

                    $this->onJobFailedEvent($this->execution, $exception);

                    throw $exception;
                }
            }


            $sleep = true;

            $executionTime = microtime(true) - $start;

            $percent = floor($executionTime / $averageDuration * 100);

            $this->onJobProgressEvent($this->execution, (int) $percent);
        }

        if ($generateOutput) {
            try {
                $this->output = $resource->output($this->execution->getId());
            } catch (\Exception $e) {

            }
        }

        $this->onJobFinishEvent($this->execution);

        return $this->execution;
    }

    /**
     * @return array
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param JobExecutionEntity $entity
     * @return void
     */
    private function onJobStartEvent(JobExecutionEntity $entity)
    {
        if (!is_null($this->onJobStart)) {
            call_user_func($this->onJobStart, $entity);
        }
    }

    /**
     * @param JobExecutionEntity $entity
     * @param int                $percent
     * @return void
     */
    private function onJobProgressEvent(JobExecutionEntity $entity, $percent)
    {
        if (!is_null($this->onJobProgress)) {
            call_user_func($this->onJobProgress, $entity, $percent);
        }
    }

    /**
     * @param JobExecutionEntity $entity
     * @return void
     */
    private function onJobFinishEvent(JobExecutionEntity $entity)
    {
        if (!is_null($this->onJobFinish)) {
            call_user_func($this->onJobFinish, $entity);
        }
    }

    /**
     * @param JobExecutionEntity $entity
     * @param \Exception         $exception
     * @return void
     */
    private function onJobFailedEvent(JobExecutionEntity $entity, \Exception $exception)
    {
        if (!is_null($this->onJobFailed)) {
            call_user_func($this->onJobFailed, $entity, $exception);
        }
    }

    /**
     * @return OutputEntity
     */
    public function getOutput()
    {
        return $this->output;
    }

}