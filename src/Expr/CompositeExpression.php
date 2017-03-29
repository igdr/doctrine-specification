<?php

namespace Igdr\DoctrineSpecification\Expr;

use Doctrine\ORM\QueryBuilder;

/**
 * Expression of Expressions combined by AND or OR operation.
 */
class CompositeExpression extends AbstractExpr
{
    const TYPE_AND = 'andX';
    const TYPE_OR = 'orX';

    /**
     * @var string
     */
    private $type;

    /**
     * @var ExpressionInterface[]
     */
    private $expressions = [];

    /**
     * @param string $type
     * @param array  $expressions
     *
     * @throws \RuntimeException
     */
    public function __construct(string $type, array $expressions)
    {
        $this->type = $type;

        foreach ($expressions as $expr) {
            if (!($expr instanceof ExpressionInterface)) {
                throw new \RuntimeException("No expression given to CompositeExpression.");
            }

            $this->expressions[] = $expr;
        }
    }

    /**
     * Returns the list of expressions nested in this composite.
     *
     * @return ExpressionInterface[]
     */
    public function getExpressionList(): array
    {
        return $this->expressions;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $dqlAlias
     *
     * @return string
     */
    public function getExpr(QueryBuilder $queryBuilder, string $dqlAlias): string
    {
        return call_user_func_array(
            [$queryBuilder->expr(), $this->type],
            array_map(
                function (ExpressionInterface $expression) use ($queryBuilder, $dqlAlias) {
                    return $expression->getExpr($queryBuilder, $dqlAlias);
                },
                $this->expressions
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDqlAlias(): string
    {
        return !empty($this->expressions) ? $this->expressions[0]->getDqlAlias() : '';
    }

    /**
     * {@inheritdoc}
     */
    public function setDqlAlias(string $alias): ExpressionInterface
    {
        foreach ($this->expressions as $expression) {
            $expression->setDqlAlias($alias);
        }

        return $this;
    }
}
