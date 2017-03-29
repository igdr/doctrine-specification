<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Field instance of Class
 */
class InstanceOfX extends AbstractExpr
{
    /**
     * @var string value
     */
    protected $value;

    /**
     * @param string      $value
     * @param string|null $dqlAlias
     */
    public function __construct(string $value, string $dqlAlias = null)
    {
        $this->dqlAlias = $dqlAlias;
        $this->value = $value;
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

        return sprintf('%s INSTANCE OF %s', $dqlAlias, $this->value);
    }
}
