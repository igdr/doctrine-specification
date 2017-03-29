<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds a condition: field in values
 */
class In extends AbstractExpr
{
    /**
     * @var string field
     */
    protected $field;

    /**
     * @var mixed value
     */
    protected $value;

    /**
     * @param string $field
     * @param array  $value
     * @param string $dqlAlias
     */
    public function __construct(string $field, array $value, string $dqlAlias = null)
    {
        $this->field = $field;
        $this->value = $value;
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

        $paramName = $this->getParameterName($queryBuilder);
        $queryBuilder->setParameter($paramName, $this->value);

        return (string) $queryBuilder->expr()->in(
            sprintf('%s.%s', $dqlAlias, $this->field),
            sprintf(':%s', $paramName)
        );
    }

    /**
     * Get a good unique parameter name.
     *
     * @param QueryBuilder $queryBuilder
     *
     * @return string
     */
    protected function getParameterName(QueryBuilder $queryBuilder): string
    {
        return sprintf('in_%d', $queryBuilder->getParameters()->count());
    }
}
