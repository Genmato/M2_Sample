<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model\Sample;

use Magento\Framework\Config\Data\Scoped;
use Genmato\Sample\Model\Sample\Reader;
use Magento\Framework\Config\ScopeInterface;
use Magento\Framework\Config\CacheInterface;

class Data extends Scoped
{
    /**
     * Scope priority loading scheme
     *
     * @var array
     */
    protected $_scopePriorityScheme = ['global'];

    /**
     * @param Reader $reader
     * @param ScopeInterface $configScope
     * @param CacheInterface $cache
     * @param string $cacheId
     */
    public function __construct(
        Reader $reader,
        ScopeInterface $configScope,
        CacheInterface $cache,
        $cacheId = 'sample_config_cache'
    ) {
        parent::__construct($reader, $configScope, $cache, $cacheId);
    }
}