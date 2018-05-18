<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class JvmEntity
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $vendor;

    /**
     * @var string
     */
    private $version;

    /**
     * @var string
     */
    private $implementationVersion;

    /**
     * JvmEntity constructor.
     *
     * @param string $name
     * @param string $vendor
     * @param string $version
     * @param string $implementationVersion
     */
    public function __construct($name, $vendor, $version, $implementationVersion)
    {
        $this->name = $name;
        $this->vendor = $vendor;
        $this->version = $version;
        $this->implementationVersion = $implementationVersion;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
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
    public function getImplementationVersion()
    {
        return $this->implementationVersion;
    }

}