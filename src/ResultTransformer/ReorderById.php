<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

/**
 * Reorders result collection by ids which are provided in constructor
 */
class ReorderByIds implements ResultTransformerInterface
{
    /**
     * @var array
     */
    protected $ids;

    /**
     * ReorderByIds constructor.
     *
     * @param array $ids
     */
    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        $flipped = array_flip($this->ids);
        usort($result, function ($entity1, $entity2) use ($flipped) {
            return $flipped[$entity1->getId()] <=> $flipped[$entity2->getId()];
        });

        return $result;
    }
}