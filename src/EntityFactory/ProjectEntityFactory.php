<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\EntityFactory;

use FtwSoft\Rundeck\Entity\ProjectEntity;

class ProjectEntityFactory
{
    public static function createFromArray(array $project): ProjectEntity
    {
        return new ProjectEntity(
            $project['name'],
            $project['description'],
            $project['url'],
            isset($project['config']) ? $project['config'] : []
        );
    }
}
