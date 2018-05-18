<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class RundeckEntity
{

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $build;

    /**
     * @var string
     */
    private $node;

    /**
     * @var string
     */
    private $base;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var string|null
     */
    private $serverUUID;

    /**
     * RundeckEntity constructor.
     *
     * @param string      $version
     * @param string      $build
     * @param string      $node
     * @param string      $base
     * @param string      $apiVersion
     * @param null|string $serverUUID
     */
    public function __construct($version, $build, $node, $base, $apiVersion, $serverUUID)
    {
        $this->version = $version;
        $this->build = $build;
        $this->node = $node;
        $this->base = $base;
        $this->apiVersion = $apiVersion;
        $this->serverUUID = $serverUUID;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return string
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @return string
     */
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * @return null|string
     */
    public function getServerUUID()
    {
        return $this->serverUUID;
    }

}