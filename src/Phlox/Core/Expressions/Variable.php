<?php

declare(strict_types=1);
/**
 * Variable expression
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
use SchrodtSven\Phlox\ExprVisitor;

class Variable extends Expression
{
	public function __construct(private Token $name)
	{
		
	}

	public function accept(ExprVisitor $ExprVisitor)
	{
		return $ExprVisitor->visitVariableExpression($this);
	}

	/**
	 * Get the value of name
	 */
	public function getName(): Token
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 */
	public function setName(Token$name): self
	{
		$this->name = $name;

		return $this;
	}
}
