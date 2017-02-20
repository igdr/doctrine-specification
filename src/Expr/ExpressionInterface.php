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
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function getExpr(QueryBuilder $queryBuilder, string $dqlAlias): string;
}
