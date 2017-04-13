<?php

namespace Igdr\DoctrineSpecification\QueryModifier;

use Doctrine\ORM\QueryBuilder;

/**
 * Adds to the query COUNT construction
 */
class Count extends AbstractQueryModifier
{
    /**
     * @var int limit
     */
    protected $field;

    /**
     * @var string
     */
    protected $asName;

    /**
     * @param string $field
     * @param string $dqlAlias
     * @param string $asName
     */
    public function __construct(string $field, string $asName = null, string $dqlAlias = null)
    {
        $this->field = $field;
        $this->dqlAlias = $dqlAlias;
        $this->asName = $asName;
    }

    /**
     * {@inheritdoc}
     */
    public function modify(QueryBuilder $queryBuilder, string $dqlAlias)
    {
        if ($this->dqlAlias !== null) {
            $dqlAlias = $this->dqlAlias;
        }
        $queryBuilder->resetDQLPart('select');

        if (null == $this->asName) {
            $queryBuilder->addSelect(sprintf('COUNT(%s.%s)', $dqlAlias, $this->field));
        } else {
            $queryBuilder->addSelect(sprintf('COUNT(%s.%s) as %s', $dqlAlias, $this->field, $this->asName));
        }
    }
}
