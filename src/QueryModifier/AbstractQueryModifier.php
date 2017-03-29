<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

/**
 * Abstract expression
 */
abstract class AbstractQueryModifier implements QueryModifierInterface
{
    /**
     * @var string
     */
    protected $dqlAlias;

    /**
     * {@inheritdoc}
     */
    public function getDqlAlias(): string
    {
        return (string) $this->dqlAlias;
    }

    /**
     * {@inheritdoc}
     */
    public function setDqlAlias(string $alias): QueryModifierInterface
    {
        $this->dqlAlias = $alias;

        return $this;
    }
}
