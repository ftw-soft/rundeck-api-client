<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\EntityFactory;


use FtwSoft\Rundeck\Entity\System\AdditionalInfoEntity;
use FtwSoft\Rundeck\Entity\System\CpuEntity;
use FtwSoft\Rundeck\Entity\System\CpuLoadAverageEntity;
use FtwSoft\Rundeck\Entity\System\ExecutionsEntity;
use FtwSoft\Rundeck\Entity\System\JvmEntity;
use FtwSoft\Rundeck\Entity\System\MemoryEntity;
use FtwSoft\Rundeck\Entity\System\OsEntity;
use FtwSoft\Rundeck\Entity\System\RundeckEntity;
use FtwSoft\Rundeck\Entity\System\SchedulerEntity;
use FtwSoft\Rundeck\Entity\System\StatsEntity;
use FtwSoft\Rundeck\Entity\System\SystemEntity;
use FtwSoft\Rundeck\Entity\System\ThreadsEntity;
use FtwSoft\Rundeck\Entity\System\TimestampEntity;
use FtwSoft\Rundeck\Entity\System\UptimeEntity;

class SystemEntityFactory
{
    use StaticClass;

    /**
     * @param array $system
     *
     * @return SystemEntity
     */
    public static function createFromArray(array $system)
    {
        $timestamp = new TimestampEntity(
            $system['timestamp']['epoch'],
            $system['timestamp']['unit'],
            new \DateTime($system['timestamp']['datetime'])
        );

        $rundeck = new RundeckEntity(
            $system['rundeck']['version'],
            $system['rundeck']['build'],
            $system['rundeck']['node'],
            $system['rundeck']['base'],
            $system['rundeck']['apiversion'],
            $system['rundeck']['serverUUID']
        );

        $executions = new ExecutionsEntity(
            $system['executions']['active'],
            $system['executions']['executionMode']
        );

        $os = new OsEntity(
            $system['os']['arch'],
            $system['os']['name'],
            $system['os']['version']
        );

        $jvm = new JvmEntity(
            $system['jvm']['name'],
            $system['jvm']['vendor'],
            $system['jvm']['version'],
            $system['jvm']['implementationVersion']
        );

        $stats = new StatsEntity(
            new UptimeEntity(
                $system['stats']['uptime']['duration'],
                $system['stats']['uptime']['unit'],
                new TimestampEntity(
                    $system['stats']['uptime']['since']['epoch'],
                    $system['stats']['uptime']['since']['unit'],
                    new \DateTime($system['stats']['uptime']['since']['datetime'])
                )
            ),
            new CpuEntity(
                new CpuLoadAverageEntity(
                    $system['stats']['cpu']['loadAverage']['unit'],
                    $system['stats']['cpu']['loadAverage']['average']
                ),
                $system['stats']['cpu']['processors']
            ),
            new MemoryEntity(
                $system['stats']['memory']['unit'],
                $system['stats']['memory']['max'],
                $system['stats']['memory']['free'],
                $system['stats']['memory']['total']
            ),
            new SchedulerEntity(
                $system['stats']['scheduler']['running'],
                $system['stats']['scheduler']['threadPoolSize']
            ),
            new ThreadsEntity(
                $system['stats']['threads']['active']
            )
        );

        $additional = [];

        foreach ($system as $key => $value) {
            if (is_array($value) && ['href', 'contentType'] === array_keys($value)) {
                $additional[$key] = new AdditionalInfoEntity($value['href'], $value['contentType']);
            }
        }

        return new SystemEntity($timestamp, $rundeck, $executions, $os, $jvm, $stats, $additional);
    }

}