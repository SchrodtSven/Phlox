<?php

declare(strict_types=1);
/**
 * Function Statement
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
use SchrodtSven\Phlox\Token;

class FunctionStmt extends Statement
{
	private static string  $foo = "Fooo";

	public function __construct(private Token $name, private array $parameters, private array $body) {}

	public function accept(StmtVisitor $visitor)
	{
		$visitor->visitFunctionStatement($this);
	}

	/**
	 * Get the value of name
	 */
	public function getName():Token
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
	 * Get the value of parameters
	 */
	public function getParameters(): array
	{
		return $this->parameters;
	}

	/**
	 * Set the value of parameters
	 */
	public function setParameters(array $parameters): self
	{
		$this->parameters = $parameters;

		return $this;
	}

	/**
	 * Get the value of body
	 */
	public function getBody(): array
	{
		return $this->body;
	}

	/**
	 * Set the value of body
	 */
	public function setBody(array $body): self
	{
		$this->body = $body;

		return $this;
	}
}