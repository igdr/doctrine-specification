<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the query ORDER BY construction
 */
class OrderBy extends AbstractQueryModifier
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

        if (!empty($dqlAlias)) {
            $queryBuilder->addOrderBy(sprintf('%s.%s', $dqlAlias, $this->field), $this->order);
        } else {
            $queryBuilder->addOrderBy($this->field, $this->order);
        }
    }
}
