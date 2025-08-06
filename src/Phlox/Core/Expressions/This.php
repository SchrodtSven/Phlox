<?php

declare(strict_types=1);
/**
 * This expression
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

class This extends Expression
{
	public function __construct(private Token $keyword)
	{
		$this->keyword = $keyword;
	}

	public function accept(Visitor $visitor)
	{
		return $visitor->visitThisExpression($this);
	}


	/**
	 * Get the value of keyword
	 */
	public function getKeyword()
	{
		return $this->keyword;
	}

	/**
	 * Set the value of keyword
	 */
	public function setKeyword($keyword): self
	{
		$this->keyword = $keyword;

		return $this;
	}
}