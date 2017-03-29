<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Transform result as associative array (map) with key and value which pass as constuctor parameter
 */
class Map implements ResultTransformerInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * Map constructor.
     *
     * @param string $key
     * @param string $value
     */
    public function __construct(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $values = [];
        foreach ($result as &$item) {
            $values[$propertyAccessor->getValue($item, $this->key)] = $propertyAccessor->getValue($item, $this->value);
        }

        return $values;
    }
}
