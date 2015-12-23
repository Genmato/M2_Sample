<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Api\Data;

use Genmato\Sample\Api\Data\DemoExtensionInterface;
use Magento\Framework\Api\ExtensibleDataInterface;

interface DemoInterface extends ExtensibleDataInterface
{

    const ID = 'id';
    const TITLE = 'title';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';
    const IS_ACTIVE = 'is_active';
    const IS_VISIBLE = 'is_visible';

    /**
     * Get id
     *
     * @api
     * @return int|null
     */
    public function getId();

    /**
     * Set id
     *
     * @api
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Title
     *
     * @api
     * @return string
     */
    public function getTitle();

    /**
     * Set Title
     *
     * @api
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Get Is Active
     *
     * @api
     * @return bool
     */
    public function getIsActive();

    /**
     * Set Is Active
     *
     * @api
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive);

    /**
     * Get Is Visible
     *
     * @api
     * @return bool
     */
    public function getIsVisible();

    /**
     * Set Is Active
     *
     * @api
     * @param bool $isVisible
     * @return $this
     */
    public function setIsVisible($isVisible);

    /**
     * Get creation time
     *
     * @api
     * @return string
     */
    public function getCreationTime();

    /**
     * Set creation time
     *
     * @api
     * @param string $creationTime
     * @return $this
     */
    public function setCreationTime($creationTime);

    /**
     * Get update time
     *
     * @api
     * @return string
     */
    public function getUpdateTime();

    /**
     * Set update time
     *
     * @api
     * @param string $updateTime
     * @return $this
     */
    public function setUpdateTime($updateTime);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @api
     * @return DemoExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @api
     * @param DemoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(DemoExtensionInterface $extensionAttributes);
}