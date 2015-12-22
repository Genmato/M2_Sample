<?php
/**
 * Genmato_Sample
 *
 * @package Genmato_Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-21
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Plugin;

use Magento\Cms\Model\Page;

class BeforePage
{
    public function beforeSetContent(Page $subject, $content)
    {
        return $subject->setContent('<!--'.$content.'-->');
    }

}