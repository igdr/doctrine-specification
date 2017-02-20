<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the query JOIN construction
 */
abstract class AbstractJoin implements QueryModifierInterface
{
    /**
     * @var string field
     */
    private $field;

    /**
     * @var string alias
     */
    private $newAlias;

    /**
     * @var string dqlAlias
     */
    private $dqlAlias;

    /**
     * @param string $field
     * @param string $newAlias
     * @param string $dqlAlias
     */
    public function __construct(string $field, string $newAlias, string $dqlAlias = null)
    {
        $this->field = $field;
        $this->newAlias = $newAlias;
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

        $join = $this->getJoinType();
        $queryBuilder->$join(sprintf('%s.%s', $dqlAlias, $this->field), $this->newAlias);
    }

    /**
     * Return a join type (ie a function of QueryBuilder) like: "join", "innerJoin", "leftJoin".
     *
     * @return string
     */
    abstract protected function getJoinType(): string;
}
