<?php

namespace Igdr\DoctrineSpecification\Expr;

/**
 * Adds a condition: field <= value
 */
class LessOrEqualThan extends Comparison
{
    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     */
    public function __construct(string $field, $value, string $dqlAlias = null)
    {
        parent::__construct(self::LTE, $field, $value, $dqlAlias);
    }
}
