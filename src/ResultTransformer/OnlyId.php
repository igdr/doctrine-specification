<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Transform result as associative array with key which pass as constuctor parameter
 */
class OnlyId implements ResultTransformerInterface
{
    const ID_KEY = 'id';

    /**
     * @var string
     */
    private $key;

    /**
     * @param string $idKey
     */
    public function __construct(string $idKey = self::ID_KEY)
    {
        $this->key = $idKey;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $ids = [];
        foreach ($result as &$item) {
            $ids[] = $propertyAccessor->getValue($item, $this->key);
        }

        return $ids;
    }
}
