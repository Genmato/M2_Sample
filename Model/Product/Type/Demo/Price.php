<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model\Product\Type\Demo;

use Magento\Catalog\Model\Product\Type\Price as ProductPrice;

class Price extends ProductPrice
{

    /**
     * Default action to get price of product
     *
     * @param Product $product
     * @return float
     */
    public function getPrice($product)
    {
        return $product->getData('cost')*1.25;
    }
}