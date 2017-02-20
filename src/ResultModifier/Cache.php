<?php

namespace Igdr\DoctrineSpecification\ResultModifier;

use Doctrine\ORM\AbstractQuery;

/**
 * Add case parameters to query
 */
class Cache implements ResultModifierInterface
{
    /**
     * @var int How may seconds the cache entry is valid
     */
    private $cacheLifetime;

    /**
     * @param int $cacheLifetime How many seconds the cached entry is valid
     */
    public function __construct(int $cacheLifetime)
    {
        $this->cacheLifetime = $cacheLifetime;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(AbstractQuery $query)
    {
        $query->setResultCacheLifetime($this->cacheLifetime);
    }
}
