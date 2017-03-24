<?php

namespace Igdr\DoctrineSpecification;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\QueryBuilder;
use Igdr\DoctrineSpecification\ResultModifier\ResultModifierInterface;
use Igdr\DoctrineSpecification\ResultTransformer\ResultTransformerInterface;

/**
 * This interface should be used by an EntityRepository implementing the Specification pattern.
 */
interface EntitySpecificationRepositoryInterface extends ObjectRepository, Selectable
{
    /**
     * Get results when you match with a Specification.
     *
     * @param SpecificationInterface     $specification
     * @param ResultTransformerInterface $resultTransformer
     * @param ResultModifierInterface    $resultModifier
     *
     * @return LazySpecificationCollection
     */
    public function match(SpecificationInterface $specification, ResultTransformerInterface $resultTransformer = null, ResultModifierInterface $resultModifier = null);

    /**
     * Get single result when you match with a Specification.
     *
     * @param SpecificationInterface     $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw \NonUniqueException  If more than one result is found
     * @throw \NoResultException   If no results found
     *
     * @return mixed
     */
    public function matchSingleResult(SpecificationInterface $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null);

    /**
     * Get single result or null when you match with a Specification.
     *
     * @param SpecificationInterface     $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw Exception\NonUniqueException  If more than one result is found
     *
     * @return mixed|null
     */
    public function matchOneOrNullResult(SpecificationInterface $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null);

    /**
     * Get doctrine query for execution
     *
     * @param SpecificationInterface       $specification
     * @param ResultModifierInterface|null $modifier
     *
     * @return \Doctrine\ORM\Query
     */
    public function getQuery(SpecificationInterface $specification, ResultModifierInterface $modifier = null): \Doctrine\ORM\Query;

    /**
     * Get query builder with applied specification
     *
     * @param \Igdr\DoctrineSpecification\SpecificationInterface $specification
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder(SpecificationInterface $specification): QueryBuilder;
}
