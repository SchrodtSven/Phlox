<?php

declare(strict_types=1);
/**
 * Print Statement
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */


namespace SchrodtSven\Phlox\Core\Statements;
use SchrodtSven\Phlox\Core\Statements\Statement;
use SchrodtSven\Phlox\StmtVisitor;
use SchrodtSven\Phlox\Core\Expressions\Expression;

class PrintStmt extends Statement
{
	public function __construct(private Expression $expression)
	{}


	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitPrintStatement($this);
	}

	/**
	 * Get the value of expression
	 */
	public function getExpression(): Expression
	{
		return $this->expression;
	}

	/**
	 * Set the value of expression
	 */
	public function setExpression(Expression $expression): self
	{
		$this->expression = $expression;

		return $this;
	}
}