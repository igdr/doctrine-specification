<?php

namespace Igdr\DoctrineSpecification\ResultTransformer;

/**
 * Collection of transformers
 */
class ResultTransformerCollection implements ResultTransformerInterface
{
    /**
     * @var ResultTransformerInterface[]
     */
    private $transformers;

    /**
     * Construct it with one or more instances of ResultModifier.
     */
    public function __construct()
    {
        $this->transformers = array_filter(func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function transform($result)
    {
        foreach ($this->transformers as $transformer) {
            if (!$transformer instanceof ResultTransformerInterface) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Child passed to ResultTransformerCollection must be an instance of %s, but instance of %s found',
                        ResultTransformerInterface::class,
                        get_class($transformer)
                    )
                );
            }

            $result = $transformer->transform($result);
        }

        return $result;
    }
}
