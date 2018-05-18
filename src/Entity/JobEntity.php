<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity;


class JobEntity
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var bool
     */
    private $scheduled;

    /**
     * @var string
     */
    private $href;

    /**
     * @var bool
     */
    private $scheduleEnabled;

    /**
     * @var bool
     */
    private $enabled;

    /**
     * @var string
     */
    private $permalink;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $group;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $project;

    /**
     * @var int ms
     */
    private $averageDuration;

    /**
     * JobEntity constructor.
     *
     * @param string $id
     * @param bool   $scheduled
     * @param string $href
     * @param bool   $scheduleEnabled
     * @param bool   $enabled
     * @param string $permalink
     * @param string $name
     * @param string $group
     * @param string $description
     * @param string $project
     * @param int    $averageDuration
     */
    public function __construct(
        $id,
        $scheduled,
        $href,
        $scheduleEnabled,
        $enabled,
        $permalink,
        $name,
        $group,
        $description,
        $project,
        $averageDuration
    )
    {
        $this->id = $id;
        $this->scheduled = boolval($scheduled);
        $this->href = $href;
        $this->scheduleEnabled = boolval($scheduleEnabled);
        $this->enabled = boolval($enabled);
        $this->permalink = $permalink;
        $this->name = $name;
        $this->group = $group;
        $this->description = $description;
        $this->project = $project;
        $this->averageDuration = $averageDuration;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isScheduled()
    {
        return $this->scheduled;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return bool
     */
    public function isScheduleEnabled()
    {
        return $this->scheduleEnabled;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return string
     */
    public function getPermalink()
    {
        return $this->permalink;
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
    public function getGroup()
    {
        return $this->group;
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
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @return int
     */
    public function getAverageDuration()
    {
        return $this->averageDuration;
    }

}