<?php

namespace Igdr\DoctrineSpecification\ResultModifier;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\Query;

/**
 * Class AsArray.
 */
class AsArray implements ResultModifierInterface
{
    /**
     * {@inheritdoc}
     */
    public function modify(AbstractQuery $query)
    {
        $query->setHydrationMode(Query::HYDRATE_ARRAY);
    }
}
