<?php

declare(strict_types=1);
/**
 * Abstract entity class for an expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-05
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use SchrodtSven\Phlox\Visitor;
use SchrodtSven\Phlox\Core\Token;
use SchrodtSven\Phlox\Core\Expressions\Expression;

class Call extends Expression
{
	public function __construct(private Expression $callee, private  Token $parent, private array $arguments) {}

	public function accept(Visitor $visitor)
	{
		return $visitor->visitCallExpression($this);
	}

	/**
	 * Get the value of callee
	 */
	public function getCallee()
	{
		return $this->callee;
	}

	/**
	 * Set the value of callee
	 */
	public function setCallee($callee): self
	{
		$this->callee = $callee;

		return $this;
	}

	/**
	 * Get the value of parent
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Set the value of parent
	 */
	public function setParent($parent): self
	{
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Get the value of arguments
	 */
	public function getArguments()
	{
		return $this->arguments;
	}

	/**
	 * Set the value of arguments
	 */
	public function setArguments($arguments): self
	{
		$this->arguments = $arguments;

		return $this;
	}
}
