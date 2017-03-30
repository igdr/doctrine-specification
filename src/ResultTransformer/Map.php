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
     * @var bool
     */
    private $multi;

    /**
     * Map constructor.
     *
     * @param string $key
     * @param string $value
     * @param bool   $multi
     */
    public function __construct(string $key, string $value, $multi = true)
    {
        $this->key = $key;
        $this->value = $value;
        $this->multi = $multi;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $values = [];
        foreach ($result as &$item) {
            if (false === $this->multi) {
                $values[$propertyAccessor->getValue($item, $this->key)] = $propertyAccessor->getValue($item, $this->value);
            } else {
                $values[$propertyAccessor->getValue($item, $this->key)][] = $propertyAccessor->getValue($item, $this->value);
            }
        }

        return $values;
    }
}
