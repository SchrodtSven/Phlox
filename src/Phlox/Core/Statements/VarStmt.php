<?php

declare(strict_types=1);
/**
 * Var Statement
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */


namespace SchrodtSven\Phlox\Core\Statements;

use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Core\Statements\Statement;
use SchrodtSven\Phlox\StmtVisitor;
use SchrodtSven\Phlox\Token;

class VarStmt extends Statement
{
	public function __construct(private Token $name, private ?Expression $initializer){}

	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitVarStatement($this);
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
	 * Get the value of initializer
	 */
	public function getInitializer(): ?Expression
	{
		return $this->initializer;
	}

	/**
	 * Set the value of initializer
	 */
	public function setInitializer(?Expression $initializer): self
	{
		$this->initializer = $initializer;

		return $this;
	}
}