<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;
use Igdr\DoctrineSpecification\Expr\ExpressionInterface;

/**
 * Adds to the query COUNT construction
 */
class Count implements QueryModifierInterface
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
        $queryBuilder->resetDQLPart('select');
        $queryBuilder->addSelect(sprintf('COUNT(%s.%s)', $dqlAlias, $this->field));
    }
}
