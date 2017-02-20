<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Not
 */
class Not implements ExpressionInterface
{
    /**
     * @var ExpressionInterface
     */
    private $expression;

    /**
     * @param \Igdr\DoctrineSpecification\Expr\ExpressionInterface $expression
     */
    public function __construct(ExpressionInterface $expression)
    {
        $this->expression = $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpr(QueryBuilder $queryBuilder, string $dqlAlias): string
    {
        return (string) $queryBuilder->expr()->not($this->expression->getExpr($queryBuilder, $dqlAlias));
    }
}
