<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

/**
 * Adds to the query JOIN construction
 */
class Join extends AbstractJoin
{
    /**
     * {@inheritdoc}
     */
    protected function getJoinType():string
    {
        return 'join';
    }
}
