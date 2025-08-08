<?php

declare(strict_types=1);
/**
 * Return Statement
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
use SchrodtSven\Phlox\Token;

class ReturnStmt extends Statement
{
	 public function __construct(private Token $keyword, private Expression $value){}

	public function accept(StmtVisitor $visitor)
	{
		return $visitor->visitReturnStatement($this);
	}

	 

	 /**
	  * Get the value of keyword
	  */
	 public function getKeyword(): Token
	 {
	 	 return $this->keyword;
	 }

	 /**
	  * Set the value of keyword
	  */
	 public function setKeyword(Token $keyword): self
	 {
	 	 $this->keyword = $keyword;

	 	 return $this;
	 }

	 /**
	  * Get the value of value
	  */
	 public function getValue(): Expression
	 {
	 	 return $this->value;
	 }

	 /**
	  * Set the value of value
	  */
	 public function setValue(Expression $value): self
	 {
	 	 $this->value = $value;

	 	 return $this;
	 }
}