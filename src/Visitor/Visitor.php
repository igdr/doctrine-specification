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
    private $method;

    /**
     * @param Specification $visitor
     * @param string        $method
     */
    public function __construct(Specification $visitor, string $method)
    {
        $this->visitor = $visitor;
        $this->method = $method;
    }

    /**
     * @param Specification $visitor
     * @param string        $method
     *
     * @return static
     */
    public static function create(Specification $visitor, string $method)
    {
        return new static($visitor, $method);
    }

    /**
     * {@inheritdoc}
     */
    public function visit(Specification $specification): void
    {
        call_user_func([$this->visitor, $this->method], $specification);
    }
}
