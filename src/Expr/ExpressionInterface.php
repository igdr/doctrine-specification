<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Expression interface
 */
interface ExpressionInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $alias
     *
     * @return string
     */
    public function getExpr(QueryBuilder $queryBuilder, string $alias): string;

    /**
     * @return string
     */
    public function getDqlAlias(): string;

    /**
     * @param string $alias
     *
     * @return ExpressionInterface
     */
    public function setDqlAlias(string $alias): ExpressionInterface;
}
