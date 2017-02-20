<?php

namespace Igdr\DoctrineSpecification\Expr;

/**
 * Adds a condition: field like a value
 */
class Like extends Comparison
{
    const CONTAINS = '%%%s%%';
    const ENDS_WITH = '%%%s';
    const STARTS_WITH = '%s%%';

    /**
     * @param string      $field
     * @param string      $value
     * @param string      $format
     * @param string|null $dqlAlias
     */
    public function __construct(string $field, string $value, string $format = self::CONTAINS, string $dqlAlias = null)
    {
        $formattedValue = $this->formatValue($format, $value);
        parent::__construct(self::LIKE, $field, $formattedValue, $dqlAlias);
    }

    /**
     * @param string $format
     * @param string $value
     *
     * @return string
     */
    private function formatValue(string $format, string $value): string
    {
        return sprintf($format, $value);
    }
}
