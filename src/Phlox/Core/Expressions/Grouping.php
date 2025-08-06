<?php

declare(strict_types=1);
/**
 *  Class for grouping expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-05
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Core\Token;
use SchrodtSven\Phlox\Visitor;

class Grouping extends Expression
{
    public function __construct(private Expression $expression) {}

    public function accept(Visitor $visitor)
    {
        return $visitor->visitGroupingExpression($this);
    }

    /**
     * Get the value of expression
     */
    public function getExpression()
    {
        return $this->expression;
    }

    /**
     * Set the value of expression
     */
    public function setExpression($expression): self
    {
        $this->expression = $expression;

        return $this;
    }
}
