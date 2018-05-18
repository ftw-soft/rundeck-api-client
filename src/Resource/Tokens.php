<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Resource;


use FtwSoft\Rundeck\EntityFactory\TokenEntityFactory;

class Tokens extends AbstractResource
{

    /**
     * @param null|string $user
     *
     * @return array
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\EntityException
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function get($user = null)
    {
        $function = "tokens";

        if ($user) {
            $function .= "/{$user}";
        }

        $response = $this->client->get($function);

        $tokens = $this->responseToArray($response);

        foreach ($tokens as $i => $token) {
            $tokens[$i] = TokenEntityFactory::createFromArray($token);
        }

        return $tokens;
    }

    /**
     * @param string $user
     * @param array  $roles
     * @param string $duration
     *
     * @return \FtwSoft\Rundeck\Entity\TokenEntity
     * @throws \Exception
     * @throws \FtwSoft\Rundeck\Exception\EntityException
     * @throws \FtwSoft\Rundeck\Exception\InvalidResourceResponseException
     */
    public function create($user, array $roles, $duration)
    {
        $response = $this->client->post('tokens/' . $user, [
            'roles'    => $roles,
            'duration' => $duration
        ]);

        $token = $this->responseToArray($response);

        return TokenEntityFactory::createFromArray($token);
    }

}