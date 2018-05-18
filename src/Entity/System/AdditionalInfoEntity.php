<?php
/**
 * @link      http://horoshop.ua
 * @copyright Copyright (c) 2015-2018 Horoshop TM
 * @author    Andrey Telesh <andrey@horoshop.ua>
 */

namespace FtwSoft\Rundeck\Entity\System;


class AdditionalInfoEntity
{

    /**
     * @var string
     */
    private $href;

    /**
     * @var string
     */
    private $contentType;

    /**
     * AdditionalInfoEntity constructor.
     *
     * @param string $href
     * @param string $contentType
     */
    public function __construct($href, $contentType)
    {
        $this->href = $href;
        $this->contentType = $contentType;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

}