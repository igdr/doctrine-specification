<?php

namespace Igdr\DoctrineSpecification;

use Doctrine\ORM\QueryBuilder;

/**
 * Apply specification to QueryBuilder
 */
class SpecificationApplier
{
    /**
     * @todo replace to some builder class for building Doctrine Query Builder
     *
     * @param SpecificationInterface     $specification
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder
     * @param string                     $alias
     */
    public static function apply(SpecificationInterface $specification, QueryBuilder $queryBuilder, string $alias = null)
    {
        if (null === $alias) {
            $alias = $queryBuilder->getRootAliases()[0];
        }

        //visitors
        $visitors = $specification->getVisitors();
        foreach ((array) $visitors as $visitor) {
            $visitor->visit($specification);
        }

        //expressions
        if ($where = $specification->getWhereExpression()) {
            $queryBuilder->where($where->getExpr($queryBuilder, $alias));
        }

        //query modifiers
        $modifiers = $specification->getQueryModifiers();
        foreach ((array) $modifiers as $modifier) {
            $modifier->modify($queryBuilder, $alias);
        }
    }
}
