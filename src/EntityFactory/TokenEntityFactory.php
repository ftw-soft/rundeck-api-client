<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\EntityFactory;


use FtwSoft\Rundeck\Entity\TokenEntity;
use FtwSoft\Rundeck\Exception\EntityException;

class TokenEntityFactory
{
    use StaticClass;

    /**
     * @param array $token
     *
     * @return TokenEntity
     * @throws EntityException
     */
    public static function createFromArray(array $token)
    {
        $requiredKeys = ['user', 'id', 'creator', 'expiration', 'roles', 'expired'];
        sort($requiredKeys);

        $keys = array_keys($token);

        sort($keys);

        if ($requiredKeys !== array_intersect($requiredKeys, $keys)) {
            throw new EntityException(
                "Some of the required keys are missing: " . implode(', ', $requiredKeys)
            );
        }

        if (!is_array($token['roles'])) {
            throw new EntityException(
                "The roles must be an array"
            );
        }

        return new TokenEntity(
            $token['user'],
            $token['id'],
            isset($token['token']) ? $token['token'] : null,
            $token['creator'],
            new \DateTime($token['expiration']),
            $token['roles'],
            boolval($token['expired'])
        );
    }

}