<?php

namespace Igdr\DoctrineSpecification;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use Igdr\DoctrineSpecification\ResultModifier\ResultModifierInterface;
use Igdr\DoctrineSpecification\ResultTransformer\ResultTransformerInterface;

/**
 * This class allows you to use a Specification to query entities.
 */
class EntitySpecificationRepository extends EntityRepository implements EntitySpecificationRepositoryInterface
{
    /**
     * @var string alias
     */
    private $alias = 'e';

    /**
     * {@inheritdoc}
     */
    public function match(Specification $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null)
    {
        $query = $this->getQuery($specification, $modifier);
        $result = $query->execute();

        if ($transformer instanceof ResultTransformerInterface) {
            $result = $transformer->transform($result);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function matchSingleResult(Specification $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null)
    {
        $result = $this->getQuery($specification, $modifier)->getSingleResult();

        if ($transformer instanceof ResultTransformerInterface) {
            $result = $transformer->transform($result);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function matchOneOrNullResult(Specification $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null)
    {
        try {
            return $this->matchSingleResult($specification, $transformer, $modifier);
        } catch (NoResultException $e) {
            return null;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getQuery(Specification $specification, ResultModifierInterface $modifier = null): \Doctrine\ORM\Query
    {
        $queryBuilder = $this->createQueryBuilder($this->alias);

        //apply specification to the query builder
        SpecificationApplier::apply($specification, $queryBuilder, $this->getAlias());

        $query = $queryBuilder->getQuery();
        if ($modifier !== null) {
            $modifier->modify($query);
        }

        return $query;
    }

    /**
     * @param string $alias
     *
     * @return $this
     */
    public function setAlias(string $alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }
}
