<?php

namespace Igdr\DoctrineSpecification\Visitor;

use Igdr\DoctrineSpecification\Specification;

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
    public function visit(Specification $specification): void;
}
