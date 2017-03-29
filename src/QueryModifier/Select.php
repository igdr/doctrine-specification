<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the query Select construction
 */
class Select extends AbstractQueryModifier
{
    /**
     * @var int limit
     */
    protected $select;

    /**
     * @param string $select
     */
    public function __construct(string $select)
    {
        $this->select = $select;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(QueryBuilder $queryBuilder, string $dqlAlias)
    {
        $queryBuilder->addSelect($this->select);
    }
}
