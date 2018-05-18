<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\Entity\TokenEntity;
use FtwSoft\Rundeck\EntityFactory\TokenEntityFactory;

class Token extends AbstractResource
{

    /**
     * @param $id
     *
     * @return TokenEntity
     * @throws \Exception
     */
    public function get($id)
    {
        $token = $this->responseToArray($this->client->get("token/{$id}"));

        return TokenEntityFactory::createFromArray($token);
    }

    /**
     * @param string $id
     *
     * @return bool
     * @throws \Exception
     */
    public function delete($id)
    {
        $response = $this->client->delete("token/{$id}");

        return $response->getStatusCode() === 204;
    }

}