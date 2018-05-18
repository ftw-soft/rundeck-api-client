<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\Entity\UserEntity;
use FtwSoft\Rundeck\EntityFactory\UserEntityFactory;

class User extends AbstractResource
{

    /**
     * @return UserEntity[]
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function listAll()
    {
        $response = $this->client->get('user/list');

        $users = $this->responseToArray($response);

        foreach ($users as $i => $user) {
            $users[$i] = UserEntityFactory::createFromArray($user);
        }

        return $users;
    }

    /**
     * @param string $user
     *
     * @return UserEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function get($user)
    {
        $response = $this->client->get("user/info/{$user}");

        $user = $this->responseToArray($response);

        return UserEntityFactory::createFromArray($user);
    }

    /**
     * @param UserEntity $user
     *
     * @return UserEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function update(UserEntity $user)
    {
        $response = $this->client->post("user/info/" . $user->getLogin(), [
            'firstName' => $user->getFirstName(),
            'lastName'  => $user->getLastName(),
            'email'     => $user->getEmail()
        ]);

        $user = $this->responseToArray($response);

        return UserEntityFactory::createFromArray($user);
    }

}