<?php
/**
 * Demo Model
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-12
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model;

use Magento\Framework\Model\AbstractModel;

class Demo extends AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Genmato\Sample\Model\ResourceModel\Demo');
    }

} 
