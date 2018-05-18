<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class OsEntity
{

    /**
     * @var string
     */
    private $arch;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $version;

    /**
     * OsEntity constructor.
     *
     * @param string $arch
     * @param string $name
     * @param string $version
     */
    public function __construct($arch, $name, $version)
    {
        $this->arch = $arch;
        $this->name = $name;
        $this->version = $version;
    }


    /**
     * @return string
     */
    public function getArch()
    {
        return $this->arch;
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
    public function getVersion()
    {
        return $this->version;
    }

}