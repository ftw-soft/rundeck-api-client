<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\Entity\JobEntity;
use FtwSoft\Rundeck\EntityFactory\JobEntityFactory;
use FtwSoft\Rundeck\EntityFactory\JobExecutionEntityFactory;

class Job extends AbstractResource
{

    const LOG_LEVEL_INFO = 'INFO';

    const LOG_LEVEL_DEBUG = 'DEBUG';

    /**
     * @param $projectName
     *
     * @return JobEntity[]
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function get($projectName)
    {
        $response = $this->client->get("project/{$projectName}/jobs");

        $jobs = $this->responseToArray($response);

        foreach ($jobs as $i => $job) {
            $jobs[$i] = JobEntityFactory::createFromArray($job);
        }

        return $jobs;
    }

    /**
     * @param string         $jobId
     * @param string         $logLevel
     * @param null           $asUser
     * @param null           $filter
     * @param \DateTime|null $runAtTime
     * @param array          $options
     *
     * @return \FtwSoft\Rundeck\Entity\JobExecutionEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function run(
        $jobId,
        $logLevel = self::LOG_LEVEL_INFO,
        $asUser = null,
        $filter = null,
        \DateTime $runAtTime = null,
        array $options = []
    )
    {
        $params = [
            'logLevel' => $logLevel
        ];

        if ($asUser) {
            $params['asUser'] = $asUser;
        }

        if ($filter) {
            $params['filter'] = $filter;
        }

        if ($runAtTime) {
            $params['runAtTime'] = $runAtTime->format(\DateTime::ATOM);
        }

        $params['options'] = $options;

        $response = $this->client->post("job/{$jobId}/executions", $params);

        $execution = $this->responseToArray($response);

        return JobExecutionEntityFactory::createFromArray($execution);
    }

}