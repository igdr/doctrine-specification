<?php

namespace Igdr\DoctrineSpecification;

use Doctrine\ORM\QueryBuilder;


/**
 * Apply specification to QueryBuilder
 */
class SpecificationApplier
{
    /**
     * @param \Igdr\DoctrineSpecification\Specification $specification
     * @param \Doctrine\ORM\QueryBuilder                $queryBuilder
     * @param string                                    $alias
     */
    public static function apply(Specification $specification, QueryBuilder $queryBuilder, string $alias = null)
    {
        if (null === $alias) {
            $alias = $queryBuilder->getRootAliases()[0];
        }
        if ($where = $specification->getWhereExpression()) {
            $queryBuilder->where($where->getExpr($queryBuilder, $alias));
        }

        $modifiers = $specification->getQueryModifiers();
        foreach ((array) $modifiers as $modifier) {
            $modifier->modify($queryBuilder, $alias);
        }
    }
}
