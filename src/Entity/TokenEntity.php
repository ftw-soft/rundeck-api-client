<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity;


class TokenEntity
{

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $creator;

    /**
     * @var \DateTime
     */
    private $expiration;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var bool
     */
    private $expired;

    /**
     * TokenEntity constructor.
     *
     * @param string    $user
     * @param string    $id
     * @param string    $token
     * @param string    $creator
     * @param \DateTime $expiration
     * @param array     $roles
     * @param bool      $expired
     */
    public function __construct(
        $user,
        $id,
        $token,
        $creator,
        \DateTime $expiration,
        array $roles,
        $expired
    )
    {
        $this->user = $user;
        $this->id = $id;
        $this->token = $token;
        $this->creator = $creator;
        $this->expiration = $expiration;
        $this->roles = $roles;
        $this->expired = $expired;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @return \DateTime
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expired;
    }

}