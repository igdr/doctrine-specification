<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * QueryModifier interface
 */
interface QueryModifierInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function modify(QueryBuilder $queryBuilder, string $dqlAlias);

    /**
     * {@inheritdoc}
     */
    public function getDqlAlias(): string;

    /**
     * {@inheritdoc}
     */
    public function setDqlAlias(string $alias): QueryModifierInterface;
}
