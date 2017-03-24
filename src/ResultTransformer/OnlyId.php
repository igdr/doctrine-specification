<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

/**
 * Transform result as associative array with key which pass as constuctor parameter
 */
class OnlyId extends OnlyKey
{
    const ID_KEY = 'id';

    /**
     * @param string $key
     */
    public function __construct(string $key = self::ID_KEY)
    {
        parent::__construct($key);
    }
}
