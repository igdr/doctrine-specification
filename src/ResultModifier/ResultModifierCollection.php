<?php

namespace Igdr\DoctrineSpecification\ResultModifier;

use Doctrine\ORM\AbstractQuery;

/**
 * Class ResultModifierCollection
 */
class ResultModifierCollection implements ResultModifierInterface
{
    /**
     * @var ResultModifierInterface[]
     */
    private $resultModifiers;

    /**
     * Construct it with one or more instances of ResultModifier.
     */
    public function __construct()
    {
        $this->resultModifiers = func_get_args();
    }

    /**
     * {@inheritdoc}
     */
    public function modify(AbstractQuery $query)
    {
        foreach ($this->resultModifiers as $child) {
            if (!$child instanceof ResultModifierInterface) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Child passed to ResultModifierCollection must be an instance of Igdr\DoctrineSpecification\Result\ResultModifier, but instance of %s found',
                        get_class($child)
                    )
                );
            }

            $child->modify($query);
        }
    }
}
