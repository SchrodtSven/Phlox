<?php

declare(strict_types=1);
/**
 * If Statement
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

class IfStmt extends Statement
{
	public function __construct(private Expression $condition, private Statement $thenBranch,  private Statement $elseBranch){}

	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitIfStatement($this);
	}

	/**
	 * Get the value of condition
	 */
	public function getCondition(): Expression
	{
		return $this->condition;
	}

	/**
	 * Set the value of condition
	 */
	public function setCondition(Expression $condition): self
	{
		$this->condition = $condition;

		return $this;
	}

	/**
	 * Get the value of thenBranch
	 */ 
	public function getThenBranch(): Statement
	{
		return $this->thenBranch;
	}

	/**
	 * Set the value of thenBranch
	 *
	 * @return  self
	 */ 
	public function setThenBranch(Statement $thenBranch)
	{
		$this->thenBranch = $thenBranch;

		return $this;
	}

	/**
	 * Get the value of elseBranch
	 */ 
	public function getElseBranch(): Statement
	{
		return $this->elseBranch;
	}

	/**
	 * Set the value of elseBranch
	 *
	 * @return  self
	 */ 
	public function setElseBranch(Statement $elseBranch)
	{
		$this->elseBranch = $elseBranch;

		return $this;
	}
}