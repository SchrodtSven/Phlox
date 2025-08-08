<?php

declare(strict_types=1);
/**
 *  Class for literal expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Token;
use SchrodtSven\Phlox\ExprVisitor;

class Literal extends Expression
{
	public function __construct(private mixed $value) {}

	public function accept(ExprVisitor $ExprVisitor)
	{
		return $ExprVisitor->visitLiteralExpression($this);
	}


	/**
	 * Get the value of value
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * Set the value of value
	 *
	 * @return  self
	 */
	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}
}
