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
    public static function createFromArray(array $user): UserEntity
    {
        return static::createNewUser($user['login'], $user['firstName'], $user['lastName'], $user['email']);
    }

    public static function createNewUser(string $login, string $firstName, string $lastName, string $email): UserEntity
    {
        return new UserEntity($login, $firstName, $lastName, $email);
    }

}