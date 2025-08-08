<?php

declare(strict_types=1);
/**
 * Expression Visitor interface 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */


namespace SchrodtSven\Phlox\Core\Statements;
use SchrodtSven\Phlox\Core\Statements\Statement;
use SchrodtSven\Phlox\StmtVisitor;

class BlockStmt extends Statement
{
	public function __construct(private array $statements)
	{
	}

	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitBlockStatement($this);
	}

	

	/**
	 * Get the value of statements
	 */
	public function getStatements(): array
	{
		return $this->statements;
	}

	/**
	 * Set the value of statements
	 */
	public function setStatements(array $statements=[]): self
	{
		$this->statements = $statements;

		return $this;
	}
}