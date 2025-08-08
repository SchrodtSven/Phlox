<?php

declare(strict_types=1);
/**
 * Binary expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use Expr;
use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Token;
use SchrodtSven\Phlox\ExprVisitor;

class Binary extends Expression
{
    public function __construct(private Expression $left, private Token $operator, private Expression $right) {}

    public function accept(ExprVisitor $ExprVisitor)
    {
        return $ExprVisitor->visitBinaryExpression($this);
    }


    /**
     * Get the value of left
     */
    public function getLeft(): Expression
    {
        return $this->left;
    }

    /**
     * Set the value of left
     */
    public function setLeft(Expression $left): self
    {
        $this->left = $left;

        return $this;
    }

    /**
     * Get the value of operator
     */
    public function getOperator(): Token
    {
        return $this->operator;
    }

    /**
     * Set the value of operator
     *
     * @return  self
     */
    public function setOperator(Token $operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get the value of right
     */
    public function getRight(): Expression
    {
        return $this->right;
    }

    /**
     * Set the value of right
     */
    public function setRight(Expression $right): self
    {
        $this->right = $right;

        return $this;
    }
}
