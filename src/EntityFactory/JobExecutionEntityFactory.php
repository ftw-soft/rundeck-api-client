<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\EntityFactory;


use FtwSoft\Rundeck\Entity\JobExecutionEntity;
use FtwSoft\Rundeck\Entity\JobExecutionOutput\OutputEntity;
use FtwSoft\Rundeck\Entity\JobExecutionOutput\OutputEntryEntity;

class JobExecutionEntityFactory
{
    use StaticClass;

    public static function createFromArray(array $jobExecution)
    {
        return new JobExecutionEntity(
            $jobExecution['id'],
            $jobExecution['href'],
            $jobExecution['permalink'],
            $jobExecution['status'],
            isset($jobExecution['customStatus']) ? $jobExecution['customStatus'] : null,
            $jobExecution['project'],
            $jobExecution['executionType'],
            $jobExecution['user'],
            isset($jobExecution['serverUUID']) ? $jobExecution['serverUUID'] : null,
            isset($jobExecution['date-started']) ? new \DateTime($jobExecution['date-started']['date']) : null,
            isset($jobExecution['date-ended']['date']) ? new \DateTime($jobExecution['date-ended']['date']) : null,
            JobEntityFactory::createFromArray($jobExecution['job']),
            $jobExecution['description'],
            $jobExecution['argstring'],
            isset($jobExecution['successfulNodes']) ? $jobExecution['successfulNodes'] : [],
            isset($jobExecution['failedNodes']) ? $jobExecution['failedNodes'] : []
        );
    }

    /**
     * @param array $output
     *
     * @return OutputEntity
     */
    public static function createOutputFromArray(array $output)
    {
        $entries = [];

        foreach ($output['entries'] as $entry) {
            $entries[] = new OutputEntryEntity(
                $entry['time'],
                new \DateTime($entry['absolute_time']),
                $entry['log'],
                $entry['level'],
                $entry['user'],
                isset($entry['stepctx']) ? $entry['stepctx'] : null,
                $entry['node']
            );
        }

        return new OutputEntity(
            $output['id'],
            intval($output['offset']),
            $output['completed'],
            $output['execCompleted'],
            $output['hasFailedNodes'],
            $output['execState'],
            intval($output['lastModified']),
            $output['execDuration'],
            $output['percentLoaded'],
            $output['totalSize'],
            $output['retryBackoff'],
            $output['clusterExec'],
            $output['compacted'],
            $entries
        );
    }

}