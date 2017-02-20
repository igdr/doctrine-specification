<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the query ORDER BY construction
 */
class OrderBy implements QueryModifierInterface
{
    /**
     * @var string field
     */
    protected $field;

    /**
     * @var string order
     */
    protected $order;

    /**
     * @var string dqlAlias
     */
    protected $dqlAlias;

    /**
     * @param string      $field
     * @param string      $order
     * @param string|null $dqlAlias
     */
    public function __construct(string $field, $order = 'ASC', string $dqlAlias = null)
    {
        $this->field = $field;
        $this->order = $order;
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

        $queryBuilder->addOrderBy(sprintf('%s.%s', $dqlAlias, $this->field), $this->order);
    }
}
