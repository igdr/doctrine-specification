<?php

namespace Igdr\DoctrineSpecification;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
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
     * @param Specification              $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @return mixed[]
     */
    public function match(Specification $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null);

    /**
     * Get single result when you match with a Specification.
     *
     * @param Specification              $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw \NonUniqueException  If more than one result is found
     * @throw \NoResultException   If no results found
     *
     * @return mixed
     */
    public function matchSingleResult(Specification $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null);

    /**
     * Get single result or null when you match with a Specification.
     *
     * @param Specification              $specification
     * @param ResultTransformerInterface $transformer
     * @param ResultModifierInterface    $modifier
     *
     * @throw Exception\NonUniqueException  If more than one result is found
     *
     * @return mixed|null
     */
    public function matchOneOrNullResult(Specification $specification, ResultTransformerInterface $transformer = null, ResultModifierInterface $modifier = null);

    /**
     * @param Specification                $specification
     * @param ResultModifierInterface|null $modifier
     *
     * @return \Doctrine\ORM\Query
     */
    public function getQuery(Specification $specification, ResultModifierInterface $modifier = null): \Doctrine\ORM\Query;
}
