<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the query GROUP BY construction
 */
class GroupBy implements QueryModifierInterface
{
    /**
     * @var int limit
     */
    protected $field;

    /**
     * @var string dqlAlias
     */
    protected $dqlAlias;

    /**
     * @param string $field
     * @param string $dqlAlias
     */
    public function __construct(string $field, string $dqlAlias = null)
    {
        $this->field = $field;
        $this->dqlAlias = $dqlAlias;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(QueryBuilder $queryBuilder, string $dqlAlias)
    {
        if ($this->dqlAlias !== null) {
            $dqlAlias = $this->dqlAlias;
        }
        $queryBuilder->addGroupBy(sprintf('%s.%s', $dqlAlias, $this->field));
    }
}
