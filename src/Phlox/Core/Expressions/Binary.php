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

use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Core\Token;
use SchrodtSven\Phlox\Visitor;

class Binary extends Expression
{
    public function __construct(private Expression $left, private Token $operator, private Expression $right) {}

    public function accept(Visitor $visitor)
    {
        return $visitor->visitBinaryExpression($this);
    }


    /**
     * Get the value of left
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * Set the value of left
     */
    public function setLeft($left): self
    {
        $this->left = $left;

        return $this;
    }

    /**
     * Get the value of operator
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set the value of operator
     *
     * @return  self
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }
}
