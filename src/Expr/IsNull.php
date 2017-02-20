<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds a condition: field in null
 */
class IsNull implements ExpressionInterface
{
    /**
     * @var string field
     */
    protected $field;

    /**
     * @var null|string dqlAlias
     */
    protected $dqlAlias;

    /**
     * @param string      $field
     * @param string|null $dqlAlias
     */
    public function __construct(string $field, string $dqlAlias = null)
    {
        $this->field = $field;
        $this->dqlAlias = $dqlAlias;
    }

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

        return (string) $queryBuilder->expr()->isNull(sprintf('%s.%s', $dqlAlias, $this->field));
    }
}
