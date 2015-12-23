<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Genmato\Sample\Api\Data\DemoInterface;
use Genmato\Sample\Api\Data\DemoExtensionInterface;

class Demo extends AbstractExtensibleObject implements DemoInterface
{

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_get(self::TITLE);
    }

    /**
     * Set code
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Is Active
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->_get(self::IS_ACTIVE);
    }

    /**
     * Set Is Active
     *
     * @param bool $isActive
     * @return $this
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * Get Is Visible
     *
     * @return bool
     */
    public function getIsVisible()
    {
        return $this->_get(self::IS_VISIBLE);
    }

    /**
     * Set Is Active
     *
     * @param bool $isVisible
     * @return $this
     */
    public function setIsVisible($isVisible)
    {
        return $this->setData(self::IS_VISIBLE, $isVisible);
    }

    /**
     * Get creation time
     *
     * @return string
     */
    public function getCreationTime()
    {
        return $this->_get(self::CREATION_TIME);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return $this
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Get update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->_get(self::UPDATE_TIME);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return $this
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * {@inheritdoc}
     *
     * @return DemoExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param DemoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(DemoExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}