<?php
/**
 * Demo Collection
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-12
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model\ResourceModel\Demo;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'demo_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Genmato\Sample\Model\Demo', 'Genmato\Sample\Model\ResourceModel\Demo');
    }

    /**
     * OptionArray for records in genmato_demo
     *
     * @return array
     */
    public function toOptionIdArray()
    {
        $res = [];
        $res[] = ['value'=>'', 'label'=>__('Please Select')];
        foreach ($this as $item) {
            $data['value'] = $item->getData('demo_id');;
            $data['label'] = $item->getData('title');

            $res[] = $data;
        }

        return $res;
    }
} 
