<?php

namespace Igdr\DoctrineSpecification\Expr;

/**
 * Adds a condition: field <> value
 */
class NotEquals extends Comparison
{
    /**
     * @param string      $field
     * @param mixed       $value
     * @param string|null $dqlAlias
     */
    public function __construct(string $field, $value, string $dqlAlias = null)
    {
        parent::__construct(self::NEQ, $field, $value, $dqlAlias);
    }
}
