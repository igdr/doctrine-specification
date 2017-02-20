<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds a condition: field in not null
 */
class IsNotNull extends IsNull
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function getExpr(QueryBuilder $queryBuilder, string $dqlAlias): string
    {
        if ($this->dqlAlias !== null) {
            $dqlAlias = $this->dqlAlias;
        }

        return (string) $queryBuilder->expr()->isNotNull(sprintf('%s.%s', $dqlAlias, $this->field));
    }
}
