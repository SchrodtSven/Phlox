<?php

declare(strict_types=1);
/**
 * Class Stament
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
use SchrodtSven\Phlox\Core\Expressions\Variable;
use SchrodtSven\Phlox\Core\Token;

class ClassStmt extends Statement
{
	public function __construct(private Token $name, private ?Variable $superclass, private array $methods)
	{
		
	}

	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitClassStatement($this);
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
	 * Get the value of superclass
	 */
	public function getSuperclass(): Variable
	{
		return $this->superclass;
	}

	/**
	 * Set the value of superclass
	 */
	public function setSuperclass(Variable $superclass): self
	{
		$this->superclass = $superclass;

		return $this;
	}

	/**
	 * Get the value of methods
	 */
	public function getMethods(): array
	{
		return $this->methods;
	}

	/**
	 * Set the value of methods
	 */
	public function setMethods(array $methods): self
	{
		$this->methods = $methods;

		return $this;
	}
}