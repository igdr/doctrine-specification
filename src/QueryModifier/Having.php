<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;
use Igdr\DoctrineSpecification\Expr\ExpressionInterface;

/**
 * Adds to the query HAVING construction
 */
class Having extends AbstractQueryModifier
{
    /**
     * @var ExpressionInterface
     */
    protected $expression;

    /**
     * @param ExpressionInterface $expression
     */
    public function __construct(ExpressionInterface $expression)
    {
        $this->expression = $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(QueryBuilder $queryBuilder, string $dqlAlias)
    {
        $queryBuilder->having($this->expression->getExpr($queryBuilder, $dqlAlias));
    }

    /**
     * {@inheritdoc}
     */
    public function getDqlAlias(): string
    {
        return $this->expression->getDqlAlias();
    }

    /**
     * {@inheritdoc}
     */
    public function setDqlAlias(string $alias): QueryModifierInterface
    {
        $this->expression->setDqlAlias($alias);

        return $this;
    }


}
