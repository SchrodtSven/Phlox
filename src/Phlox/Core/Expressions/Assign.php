<?php

declare(strict_types=1);
/**
 * Class for an assign expression
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
use SchrodtSven\Phlox\ExprVisitor;

class Assign extends Expression
{
	public function __construct(private Token $name, private Expression $value)
	{}

	public function accept(ExprVisitor $ExprVisitor)
	{
		return $ExprVisitor->visitAssignExpression($this);
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
	public function setName(Token $name): self
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of value
	 */
	public function getValue(): Expression
	{
		return $this->value;
	}

	/**
	 * Set the value of value
	 */
	public function setValue(Expression $value): self
	{
		$this->value = $value;

		return $this;
	}
}
