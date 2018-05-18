<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\EntityFactory\JobExecutionEntityFactory;

class Execution extends AbstractResource
{

    /**
     * @param string $id
     *
     * @return \FtwSoft\Rundeck\Entity\JobExecutionEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function get($id)
    {
        $response = $this->client->get("execution/{$id}");

        $execution = $this->responseToArray($response);

        return JobExecutionEntityFactory::createFromArray($execution);
    }

    /**
     * @param string $id
     *
     * @return \FtwSoft\Rundeck\Entity\JobExecutionOutput\OutputEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function output($id)
    {
        $response = $this->client->get("execution/{$id}/output");

        $execution = $this->responseToArray($response);

        return JobExecutionEntityFactory::createOutputFromArray($execution);
    }

}