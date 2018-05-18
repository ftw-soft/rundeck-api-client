<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\EntityFactory\ProjectEntityFactory;

class Project extends AbstractResource
{

    /**
     * @param $project
     *
     * @return \FtwSoft\Rundeck\Entity\ProjectEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function get($project)
    {
        $response = $this->client->get("project/{$project}");

        $project = $this->responseToArray($response);

        return ProjectEntityFactory::createFromArray($project);
    }

}