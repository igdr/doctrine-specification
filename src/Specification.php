<?php

namespace Igdr\DoctrineSpecification;

use Igdr\DoctrineSpecification\Expr\CompositeExpression;
use Igdr\DoctrineSpecification\Expr\ExpressionBuilder;
use Igdr\DoctrineSpecification\Expr\ExpressionInterface;
use Igdr\DoctrineSpecification\QueryModifier\GroupBy;
use Igdr\DoctrineSpecification\QueryModifier\Having;
use Igdr\DoctrineSpecification\QueryModifier\InnerJoin;
use Igdr\DoctrineSpecification\QueryModifier\LeftJoin;
use Igdr\DoctrineSpecification\QueryModifier\Limit;
use Igdr\DoctrineSpecification\QueryModifier\Offset;
use Igdr\DoctrineSpecification\QueryModifier\OrderBy;
use Igdr\DoctrineSpecification\QueryModifier\QueryModifierInterface;
use Igdr\DoctrineSpecification\QueryModifier\Select;

/**
 * Specification
 */
class Specification
{
    /**
     * @var QueryModifierInterface[]
     */
    private $queryModifiers;

    /**
     * @var ExpressionInterface
     */
    private $expression;

    /**
     * @var ExpressionBuilder
     */
    private static $expressionBuilder;

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Returns the expression builder.
     *
     * @return ExpressionBuilder
     */
    public static function expr()
    {
        if (self::$expressionBuilder === null) {
            self::$expressionBuilder = new ExpressionBuilder();
        }

        return self::$expressionBuilder;
    }

    /**
     * Adds to the query builder select construction
     *
     * @param string $select
     *
     * @return $this
     */
    public function select(string $select)
    {
        $this->queryModifiers[] = new Select($select);

        return $this;
    }

    /**
     * Sets the where expression to evaluate when this Specification is searched for.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function where(ExpressionInterface $expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * Appends the where expression to evaluate when this Specification is searched for
     * using an AND with previous expression.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function andWhere(ExpressionInterface $expression)
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }

        $this->expression = new CompositeExpression(CompositeExpression::TYPE_AND, array(
            $this->expression,
            $expression,
        ));

        return $this;
    }

    /**
     * Appends the where expression to evaluate when this Specification is searched for
     * using an OR with previous expression.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function orWhere(ExpressionInterface $expression)
    {
        if ($this->expression === null) {
            return $this->where($expression);
        }

        $this->expression = new CompositeExpression(CompositeExpression::TYPE_OR, array(
            $this->expression,
            $expression,
        ));

        return $this;
    }

    /**
     * Gets the expression attached to this Specification.
     *
     * @return ExpressionInterface|null
     */
    public function getWhereExpression()
    {
        return $this->expression;
    }

    /**
     * Gets the expression attached to this Specification.
     *
     * @return QueryModifierInterface[]
     */
    public function getQueryModifiers()
    {
        return $this->queryModifiers;
    }

    /**
     * @param string      $field
     * @param string      $newAlias
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function leftJoin(string $field, string $newAlias, string $dqlAlias = null)
    {
        return $this->join(LeftJoin::class, $field, $newAlias, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param string      $newAlias
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function innerJoin(string $field, string $newAlias, string $dqlAlias = null)
    {
        return $this->join(InnerJoin::class, $field, $newAlias, $dqlAlias);
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function limit(int $count)
    {
        $this->queryModifiers[] = new Limit($count);

        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function offset(int $count)
    {
        $this->queryModifiers[] = new Offset($count);

        return $this;
    }

    /**
     * @param string      $field
     * @param string      $order
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function orderBy(string $field, string $order = 'ASC', string $dqlAlias = null)
    {
        $this->queryModifiers[] = new OrderBy($field, $order, $dqlAlias);

        return $this;
    }

    /**
     * @param string      $field
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function groupBy(string $field, string $dqlAlias = null)
    {
        $this->queryModifiers[] = new GroupBy($field, $dqlAlias);

        return $this;
    }

    /**
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function having(ExpressionInterface $expression)
    {
        $this->queryModifiers[] = new Having($expression);

        return $this;
    }

    /**
     * @param string      $type
     * @param string      $field
     * @param string      $newAlias
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    private function join(string $type, $field, $newAlias, $dqlAlias = null)
    {
        $key = 'join_'.$field;
        if (false === isset($this->queryModifiers[$key])) {
            $this->queryModifiers[$key] = new $type($field, $newAlias, $dqlAlias);
        }

        return $this;
    }
}
