<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\EntityFactory;


use FtwSoft\Rundeck\Entity\UserEntity;

class UserEntityFactory
{
    use StaticClass;

    /**
     * @param array $user
     *
     * @return UserEntity
     */
    public static function createFromArray(array $user)
    {
        return static::createNewUser($user['login'], $user['firstName'], $user['lastName'], $user['email']);
    }

    /**
     * @param string $login
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     *
     * @return UserEntity
     */
    public static function createNewUser($login, $firstName, $lastName, $email)
    {
        return new UserEntity($login, $firstName, $lastName, $email);
    }

}