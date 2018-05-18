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
    use StaticClass;

    /**
     * @param array $project
     *
     * @return ProjectEntity
     */
    public static function createFromArray(array $project)
    {
        return new ProjectEntity(
            $project['name'],
            $project['description'],
            $project['url'],
            isset($project['config']) ? $project['config'] : []
        );
    }

}