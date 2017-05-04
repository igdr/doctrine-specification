<?php

namespace Igdr\DoctrineSpecification\Visitor;

use Igdr\DoctrineSpecification\SpecificationInterface;

/**
 * Visitor
 */
class Visitor implements VisitorInterface
{
    /**
     * @var Specification
     */
    private $visitor;
    /**
     * @var string
     */
    private $field;
    /**
     * @var string
     */
    private $alias;

    /**
     * @param SpecificationInterface $visitor
     * @param string                 $field
     * @param string                 $alias
     */
    public function __construct(SpecificationInterface $visitor, string $field, ?string $alias = null)
    {
        $this->visitor = $visitor;
        $this->field = $field;
        $this->alias = $alias ?: $this->field;
    }

    /**
     * @param SpecificationInterface $visitor
     * @param string                 $field
     * @param string                 $alias
     *
     * @return static
     */
    public static function create(SpecificationInterface $visitor, string $field, ?string $alias = null)
    {
        return new static($visitor, $field, $alias);
    }

    /**
     * {@inheritdoc}
     */
    public function visit(SpecificationInterface $specification): void
    {
        //add join with the same alias as field
        $specification->innerJoin($this->field, $this->alias);
        //replace dql alias of the visitor's query builder
        $expression = $this->visitor->getWhereExpression();
        if ($expression) {
            $expression->setDQLAlias($this->alias);
            //set the expression from the visitor to the specification
            $specification->andWhere($expression);
        }
        //add to the specification all query modifiers from the visitor
        $modifiers = $this->visitor->getQueryModifiers();
        if (count($modifiers)) {
            foreach ($modifiers as $queryModifier) {
                if ('' === $queryModifier->getDqlAlias()) {
                    $queryModifier->setDqlAlias($this->alias);
                }
            }
            $specification->mergeQueryModifiers($this->visitor->getQueryModifiers());
        }
    }
}