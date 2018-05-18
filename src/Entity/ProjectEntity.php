<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity;


class ProjectEntity
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $url;

    /**
     * @var array
     */
    private $config;

    /**
     * ProjectEntity constructor.
     *
     * @param string $name
     * @param string $description
     * @param string $url
     * @param array  $config
     */
    public function __construct($name, $description, $url, array $config)
    {
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->config = $config;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

}