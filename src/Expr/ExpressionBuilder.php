<?php

namespace Igdr\DoctrineSpecification\Expr;

/**
 * Factory class for the specifications.
 */
class ExpressionBuilder
{
    /**
     * @return CompositeExpression
     */
    public function andX()
    {
        return new CompositeExpression(CompositeExpression::TYPE_AND, func_get_args());
    }

    /**
     * @return CompositeExpression
     */
    public function orX()
    {
        return new CompositeExpression(CompositeExpression::TYPE_OR, func_get_args());
    }

    /**
     * @param ExpressionInterface $expression
     *
     * @return Not
     */
    public function not(ExpressionInterface $expression): Not
    {
        return new Not($expression);
    }

    /**
     * @param string      $field
     * @param string|null $dqlAlias
     *
     * @return IsNull
     */
    public function isNull(string $field, string $dqlAlias = null): IsNull
    {
        return new IsNull($field, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param string|null $dqlAlias
     *
     * @return IsNotNull
     */
    public function isNotNull(string $field, string $dqlAlias = null): IsNotNull
    {
        return new IsNotNull($field, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param array       $value
     * @param string|null $dqlAlias
     *
     * @return In
     */
    public function in(string $field, array $value, string $dqlAlias = null): In
    {
        return new In($field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param array       $value
     * @param string|null $dqlAlias
     *
     * @return Not
     */
    public function notIn(string $field, array $value, string $dqlAlias = null): Not
    {
        return new Not(new In($field, $value, $dqlAlias));
    }

    /**
     * @param string $field
     * @param mixed  $value
     * @param null   $dqlAlias
     *
     * @return Comparison
     */
    public function eq(string $field, $value, $dqlAlias = null): Comparison
    {
        return new Comparison(Comparison::EQ, $field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     *
     * @return Comparison
     */
    public function neq(string $field, $value, string $dqlAlias = null): Comparison
    {
        return new Comparison(Comparison::NEQ, $field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     *
     * @return \Igdr\DoctrineSpecification\Expr\Comparison
     */
    public function lt(string $field, $value, string $dqlAlias = null): Comparison
    {
        return new Comparison(Comparison::LT, $field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     *
     * @return \Igdr\DoctrineSpecification\Expr\Comparison
     */
    public function lte(string $field, $value, string $dqlAlias = null): Comparison
    {
        return new Comparison(Comparison::LTE, $field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     *
     * @return \Igdr\DoctrineSpecification\Expr\Comparison
     */
    public function gt(string $field, $value, string $dqlAlias = null): Comparison
    {
        return new Comparison(Comparison::GT, $field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     *
     * @return \Igdr\DoctrineSpecification\Expr\Comparison
     */
    public function gte(string $field, $value, string $dqlAlias = null): Comparison
    {
        return new Comparison(Comparison::GTE, $field, $value, $dqlAlias);
    }

    /**
     * @param string      $field
     * @param string      $value
     * @param string      $format
     * @param string|null $dqlAlias
     *
     * @return Like
     */
    public function like(string $field, string $value, string $format = Like::CONTAINS, string $dqlAlias = null): Like
    {
        return new Like($field, $value, $format, $dqlAlias);
    }

    /**
     * @param string      $value
     * @param string|null $dqlAlias
     *
     * @return InstanceOfX
     */
    public function instanceOfX(string $value, string $dqlAlias = null): InstanceOfX
    {
        return new InstanceOfX($value, $dqlAlias);
    }
}
