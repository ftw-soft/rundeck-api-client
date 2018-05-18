<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\Entity\ProjectEntity;
use FtwSoft\Rundeck\EntityFactory\ProjectEntityFactory;

class Projects extends AbstractResource
{

    /**
     * @return ProjectEntity[]
     *
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function get()
    {
        $response = $this->client->get('projects');

        $projects = $this->responseToArray($response);

        foreach ($projects as $i => $project) {
            $projects[$i] = ProjectEntityFactory::createFromArray($project);
        }

        return $projects;
    }

}