<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the LIMIT an OFFSET
 */
class Offset implements QueryModifierInterface
{
    /**
     * @var int offset
     */
    protected $offset;

    /**
     * @param int $offset
     */
    public function __construct(int $offset)
    {
        $this->offset = $offset;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(QueryBuilder $queryBuilder, string $dqlAlias)
    {
        $queryBuilder->setFirstResult($this->offset);
    }
}
