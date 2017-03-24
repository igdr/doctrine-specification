<?php

namespace Igdr\DoctrineSpecification;

use Igdr\DoctrineSpecification\Expr\ExpressionBuilder;
use Igdr\DoctrineSpecification\Expr\ExpressionInterface;
use Igdr\DoctrineSpecification\QueryModifier\QueryModifierInterface;
use Igdr\DoctrineSpecification\Visitor\VisitorInterface;

/**
 * SpecificationInterface
 */
interface SpecificationInterface
{
    /**
     * @return static
     */
    public static function create();

    /**
     * Returns the expression builder.
     *
     * @return ExpressionBuilder
     */
    public static function expr();

    /**
     * Adds to the query builder select construction
     *
     * @param string $select
     *
     * @return $this
     */
    public function select(string $select);

    /**
     * Sets the where expression to evaluate when this Specification is searched for.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function where(ExpressionInterface $expression);

    /**
     * Appends the where expression to evaluate when this Specification is searched for
     * using an AND with previous expression.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function andWhere(ExpressionInterface $expression);

    /**
     * Appends the where expression to evaluate when this Specification is searched for
     * using an OR with previous expression.
     *
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function orWhere(ExpressionInterface $expression);

    /**
     * Gets the expression attached to this Specification.
     *
     * @return ExpressionInterface|null
     */
    public function getWhereExpression();

    /**
     * Gets the expression attached to this Specification.
     *
     * @return QueryModifierInterface[]
     */
    public function getQueryModifiers();

    /**
     * @param string      $field
     * @param string      $newAlias
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function leftJoin(string $field, string $newAlias, string $dqlAlias = null);

    /**
     * @param string      $field
     * @param string      $newAlias
     * @param string|null $dqlAlias
     * @param string|null $condition
     *
     * @return $this
     */
    public function innerJoin(string $field, string $newAlias, string $dqlAlias = null, string $condition = null);

    /**
     * @param int $count
     *
     * @return $this
     */
    public function limit(int $count);

    /**
     * @param int $count
     *
     * @return $this
     */
    public function offset(int $count);

    /**
     * @param string      $field
     * @param string      $order
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function orderBy(string $field, string $order = 'ASC', string $dqlAlias = null);

    /**
     * @param string      $field
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function groupBy(string $field, string $dqlAlias = null);

    /**
     * @param ExpressionInterface $expression
     *
     * @return $this
     */
    public function having(ExpressionInterface $expression);

    /**
     * @param string      $field
     * @param string|null $dqlAlias
     *
     * @return $this
     */
    public function count(string $field = 'id', string $dqlAlias = null);

    /**
     * @param VisitorInterface $visitor
     *
     * @return $this
     */
    public function addVisitor(VisitorInterface $visitor);

    /**
     * @return VisitorInterface[]
     */
    public function getVisitors(): array;
}
