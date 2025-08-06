<?php

declare(strict_types=1);
/**
 * Class for get expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use SchrodtSven\Phlox\Core\Token;
use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Visitor;

class Get extends Expression
{
    public function __construct(private Expression $object, private Token $name) {}

    public function accept(Visitor $visitor)
    {
        return $visitor->visitGetExpression($this);
    }

    /**
     * Get the value of object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set the value of object
     */
    public function setObject($object): self
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }
}
