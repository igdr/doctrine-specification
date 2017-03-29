<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Not
 */
class Not extends AbstractExpr
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

    /**
     * {@inheritdoc}
     */
    public function setDqlAlias(string $alias): ExpressionInterface
    {
        $this->expression->setDqlAlias($alias);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDqlAlias(): string
    {
        return $this->expression->getDqlAlias();
    }
}
