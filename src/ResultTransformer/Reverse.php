<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Fetch from the result only values with key which pass as constuctor parameter
 */
class Reverse implements ResultTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        return array_reverse($result);
    }
}
