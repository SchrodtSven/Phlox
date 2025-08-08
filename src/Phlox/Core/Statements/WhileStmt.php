<?php

declare(strict_types=1);
/**
 * While Statement
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */


namespace SchrodtSven\Phlox\Core\Statements;

use Expr;
use SchrodtSven\Phlox\Core\Statements\Statement;
use SchrodtSven\Phlox\StmtVisitor;
use SchrodtSven\Phlox\Core\Expressions\Expression;

class WhileStmt extends Statement
{
	public function __construct(private Expression $condition, private Statement $body){}

	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitWhileStatement($this);
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
	 * Get the value of body
	 */
	public function getBody(): Statement
	{
		return $this->body;
	}

	/**
	 * Set the value of body
	 */
	public function setBody(Statement $body): self
	{
		$this->body = $body;

		return $this;
	}
}