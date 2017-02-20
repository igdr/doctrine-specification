<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\Query\Expr\Comparison as DoctrineComparison;
use Doctrine\ORM\QueryBuilder;

/**
 * Comparison of a field with a value by the given operator.
 */
class Comparison implements ExpressionInterface
{
    const EQ = '=';
    const NEQ = '<>';
    const LT = '<';
    const LTE = '<=';
    const GT = '>';
    const GTE = '>=';
    const LIKE = 'LIKE';

    private static $operators = array(
        self::EQ,
        self::NEQ,
        self::LT,
        self::LTE,
        self::GT,
        self::GTE,
        self::LIKE,
    );

    /**
     * @var string field
     */
    protected $field;

    /**
     * @var string value
     */
    protected $value;

    /**
     * @var string dqlAlias
     */
    protected $dqlAlias;
    /**
     * @var string
     */
    private $operator;

    /**
     * Make sure the $field has a value equals to $value.
     *
     * @param string $operator
     * @param string $field
     * @param mixed  $value
     * @param string $dqlAlias
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $operator, string $field, $value, string $dqlAlias = null)
    {
        if (!in_array($operator, self::$operators)) {
            throw new \InvalidArgumentException(
                sprintf('"%s" is not a valid comparison operator. Valid operators are: "%s"',
                    $operator,
                    implode(', ', self::$operators)
                )
            );
        }

        $this->operator = $operator;
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

        return (string) new DoctrineComparison(sprintf('%s.%s', $dqlAlias, $this->field), $this->operator, sprintf(':%s', $paramName));
    }

    /**
     * Get a good unique parameter name.
     *
     * @param QueryBuilder $queryBuilder
     *
     * @return string
     */
    protected function getParameterName(QueryBuilder $queryBuilder)
    {
        return sprintf('comparison_%d', $queryBuilder->getParameters()->count());
    }
}
