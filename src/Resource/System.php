<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\EntityFactory\SystemEntityFactory;

class System extends AbstractResource
{

    /**
     * @return \FtwSoft\Rundeck\Entity\System\SystemEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function info()
    {
        $response = $this->client->get('system/info');

        $system = $this->responseToArray($response)['system'];

        return SystemEntityFactory::createFromArray($system);
    }

}