<?php

namespace Igdr\DoctrineSpecification\Visitor;

use Igdr\DoctrineSpecification\Specification;
use Igdr\DoctrineSpecification\SpecificationInterface;

/**
 * VisitorInterface
 */
interface VisitorInterface
{
    /**
     * @param Specification $specification
     *
     * @return void
     */
    public function visit(SpecificationInterface $specification): void;
}
