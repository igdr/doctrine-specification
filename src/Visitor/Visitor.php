<?php

namespace Igdr\DoctrineSpecification\Visitor;

use Igdr\DoctrineSpecification\Specification;

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
     * @param Specification $visitor
     * @param string        $field
     */
    public function __construct(Specification $visitor, string $field)
    {
        $this->visitor = $visitor;
        $this->field = $field;
    }

    /**
     * @param Specification $visitor
     * @param string        $field
     *
     * @return static
     */
    public static function create(Specification $visitor, string $field)
    {
        return new static($visitor, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function visit(Specification $specification): void
    {
        //add join with the same alias as field
        $specification->innerJoin($this->field, $this->field);

        //replace dql alias of the visitor's query builder
        $expression = $this->visitor->getWhereExpression();
        $expression->setDQLAlias($this->field);

        //set the expression from the visitor to the specification
        $specification->andWhere($expression);

        //add to the specification all query modifiers from the visitor
        foreach ($this->visitor->getQueryModifiers() as $queryModifier) {
            if ('' === $queryModifier->getDqlAlias()) {
                $queryModifier->setDqlAlias($this->field);
            }
        }

        $specification->mergeQueryModifiers($this->visitor->getQueryModifiers());
    }
}
