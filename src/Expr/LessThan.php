<?php

namespace Igdr\DoctrineSpecification\Expr;

/**
 * Adds a condition: field < value
 */
class LessThan extends Comparison
{
    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     */
    public function __construct(string $field, $value, string $dqlAlias = null)
    {
        parent::__construct(self::LT, $field, $value, $dqlAlias);
    }
}
