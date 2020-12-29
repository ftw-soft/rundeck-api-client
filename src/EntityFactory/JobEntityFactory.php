<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\EntityFactory;

use FtwSoft\Rundeck\Entity\JobEntity;

class JobEntityFactory
{
    public static function createFromArray(array $job): JobEntity
    {
        return new JobEntity(
            $job['id'],
            isset($job['scheduled']) ? $job['scheduled'] : null,
            $job['href'],
            isset($job['scheduleEnabled']) ? $job['scheduleEnabled'] : null,
            isset($job['enabled']) ? $job['enabled'] : null,
            $job['permalink'],
            $job['name'],
            $job['group'],
            $job['description'],
            $job['project'],
            isset($job['averageDuration']) ? $job['averageDuration'] : 0
        );
    }

}