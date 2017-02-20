<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Transform result as associative array with key which pass as constuctor parameter
 */
class AssociativeArray implements ResultTransformerInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $keys = [];
        foreach ($result as &$item) {
            $keys[] = $propertyAccessor->getValue($item, $this->key);
        }

        return array_combine($keys, $result);
    }
}
