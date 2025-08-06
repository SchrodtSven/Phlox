<?php

declare(strict_types=1);
/**
 *  Class for logiacl expression
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

class Logical extends Expression
{
	public function __construct(private Expression $left, private Token $operator, private Expression $right) {}

	public function accept($visitor)
	{
		return $visitor->visitLogicalExpr($this);
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
	 */
	public function setOperator($operator): self
	{
		$this->operator = $operator;

		return $this;
	}

	/**
	 * Get the value of right
	 */
	public function getRight()
	{
		return $this->right;
	}

	/**
	 * Set the value of right
	 */
	public function setRight($right): self
	{
		$this->right = $right;

		return $this;
	}
}
