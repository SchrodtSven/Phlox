<?php

declare(strict_types=1);
/**
 * The main parser class
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */


namespace SchrodtSven\Phlox;
use SchrodtSven\Phlox\TokenType;

use SchrodtSven\Phlox\Core\Expressions\Assign;
use SchrodtSven\Phlox\Core\Expressions\Binary;
use SchrodtSven\Phlox\Core\Expressions\Call;
use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Core\Expressions\Get;
use SchrodtSven\Phlox\Core\Expressions\Grouping;
use SchrodtSven\Phlox\Core\Expressions\Literal;
use SchrodtSven\Phlox\Core\Expressions\Logical;
use SchrodtSven\Phlox\Core\Expressions\Set;
use SchrodtSven\Phlox\Core\Expressions\Super;
use SchrodtSven\Phlox\Core\Expressions\This;
use SchrodtSven\Phlox\Core\Expressions\Unary;
use SchrodtSven\Phlox\Core\Expressions\Variable;


use SchrodtSven\Phlox\Core\Statements\BlockStmt;
use SchrodtSven\Phlox\Core\Statements\ClassStmt;
use SchrodtSven\Phlox\Core\Statements\ExpressionStmt;
use SchrodtSven\Phlox\Core\Statements\FunctionStmt;
use SchrodtSven\Phlox\Core\Statements\IfStmt;
use SchrodtSven\Phlox\Core\Statements\PrintStmt;
use SchrodtSven\Phlox\Core\Statements\ReturnStmt;
use SchrodtSven\Phlox\Core\Statements\Statement;
use SchrodtSven\Phlox\Core\Statements\VarStmt;
use SchrodtSven\Phlox\Core\Statements\WhileStmt;
use SchrodtSven\Phlox\Core\ErrorReporter;

class Parser
{
	public function __construct(
		private array $tokens = [],
		private int $current = 0
	){}

	public function parse()
	{
		$statements = [];
		while (!$this->isAtEnd()) {
			$statements[] = $this->declaration();
		}

		return $statements;
	}

	private function declaration()
	{
		try {
			if ($this->match(TokenType::TKN_CLASS)) return $this->classDeclaration();
			if ($this->match(TokenType::TKN_FUN)) return $this->method("function");
			if ($this->match(TokenType::TKN_VAR)) return $this->varDeclaration();
			return $this->statement();
		} catch (\ParseError $error) {
			$this->synchronize();
			return null;
		}
	}

	private function classDeclaration()
	{
		$name = $this->consume(TokenType::TKN_IDENTIFIER, "Expect class name.");

		$superclass = null;
		if ($this->match(TokenType::TKN_LESS)) {
			$this->consume(TokenType::TKN_IDENTIFIER, "Expect superclass name.");
			$superclass = new Variable($this->previous());
		}

		$this->consume(TokenType::TKN_LEFT_BRACE, "Expect '{' before class body.");

		$methods = [];
		while (!$this->check(TokenType::TKN_RIGHT_BRACE) && !$this->isAtEnd()) {
			$methods[] = $this->method("method");
		}

		$this->consume(TokenType::TKN_RIGHT_BRACE, "Expect '}' after class body.");

		return new ClassStmt($name, $superclass, $methods);
	}

	private function method($kind)
	{
		$name = $this->consume(TokenType::TKN_IDENTIFIER, "Expect " . $kind . " name.");

		$this->consume(TokenType::TKN_LEFT_PAREN, "Expect '(' after " . $kind . " name.");
		$parameters = [];
		if (!$this->check(TokenType::TKN_RIGHT_PAREN)) {
			do {
				if (count($parameters) >= FUNC_MAX_ARGS) {
					$this->error($this->peek(), "Cannot have more than 8 arguments.");
				}

				$parameters[] = $this->consume(TokenType::TKN_IDENTIFIER, "Expect parameter name.");
			} while ($this->match(TokenType::TKN_COMMA));
		}
		$this->consume(TokenType::TKN_RIGHT_PAREN, "Expect ')' after parameters.");

		$this->consume(TokenType::TKN_LEFT_BRACE, "Expect '{' before " . $kind . " body.");
		$body = $this->block();
		return new FunctionStmt($name, $parameters, $body);
	}

	private function varDeclaration()
	{
		$name = $this->consume(TokenType::TKN_IDENTIFIER, "Expect variable name.");

		$initializer = null;
		if ($this->match(TokenType::TKN_EQUAL)) {
			$initializer = $this->expression();
		}

		$this->consume(TokenType::TKN_SEMICOLON, "Expect ';' after variable declaration.");
		return new VarStmt($name, $initializer);
	}

	private function block()
	{
		$statements = [];

		while (!$this->check(TokenType::TKN_RIGHT_BRACE) && !$this->isAtEnd()) {
			$statements[] = $this->declaration();
		}

		$this->consume(TokenType::TKN_RIGHT_BRACE, "Expect '}' after block.");

		return $statements;
	}

	private function statement()
	{
		if ($this->match(TokenType::TKN_FOR)) return $this->forStatement();

		if ($this->match(TokenType::TKN_IF)) return $this->ifStatement();

		if ($this->match(TokenType::TKN_PRINT)) return $this->printStatement();

		if ($this->match(TokenType::TKN_RETURN)) return $this->returnStatement();

		if ($this->match(TokenType::TKN_WHILE)) return $this->whileStatement();

		if ($this->match(TokenType::TKN_LEFT_BRACE)) return new BlockStmt($this->block());

		return $this->expressionStatement();
	}

	public function returnStatement()
	{
		$keyword = $this->previous();
		$value = null;
		if (!$this->check(TokenType::TKN_SEMICOLON)) {
			$value = $this->expression();
		}

		$this->consume(TokenType::TKN_SEMICOLON, "Expect ';' after return value.");
		return new ReturnStmt($keyword, $value);
	}

	private function whileStatement()
	{
		$this->consume(TokenType::TKN_LEFT_PAREN, "Expect '(' after 'while'.");
		$condition = $this->expression();
		$this->consume(TokenType::TKN_RIGHT_PAREN, "Expect ')' after condition.");
		$body = $this->statement();

		return new WhileStmt($condition, $body);
	}

	private function forStatement()
	{
		$this->consume(TokenType::TKN_LEFT_PAREN, "Expect '(' after 'for'.");

		if ($this->match(TokenType::TKN_SEMICOLON)) {
			$initializer = null;
		} else if ($this->match(TokenType::TKN_VAR)) {
			$initializer = $this->varDeclaration();
		} else {
			$initializer = $this->expressionStatement();
		}

		$condition = null;
		if (!$this->check(TokenType::TKN_SEMICOLON)) {
			$condition = $this->expression();
		}
		$this->consume(TokenType::TKN_SEMICOLON, "Expect ';' after loop condition.");

		$increment = null;
		if (!$this->check(TokenType::TKN_RIGHT_PAREN)) {
			$increment = $this->expression();
		}
		$this->consume(TokenType::TKN_RIGHT_PAREN, "Expect ')' after for clauses.");

		$body = $this->statement();

		if ($increment !== null) {
			$body = new BlockStmt([
				$body,
				new ExpressionStmt($increment)
			]);
		}

		if ($condition === null) $condition = new Literal(true);
		$body = new WhileStmt($condition, $body);

		if ($initializer !== null) {
			$body = new BlockStmt([
				$initializer,
				$body
			]);
		}

		return $body;
	}

	private function expressionStatement()
	{
		$expr = $this->expression();
		$this->consume(TokenType::TKN_SEMICOLON, "Expect ';' after expression.");
		return new ExpressionStmt($expr);
	}

	private function printStatement()
	{
		$value = $this->expression();
		$this->consume(TokenType::TKN_SEMICOLON, "Expect ';' after value.");
		return new PrintStmt($value);
	}

	private function ifStatement()
	{
		$this->consume(TokenType::TKN_LEFT_PAREN, "Expect '(' after 'if'.");
		$condition = $this->expression();
		$this->consume(TokenType::TKN_RIGHT_PAREN, "Expect ')' after if condition.");

		$thenBranch = $this->statement();
		$elseBranch = null;
		if ($this->match(TokenType::TKN_ELSE)) {
			$elseBranch = $this->statement();
		}

		return new IfStmt($condition, $thenBranch, $elseBranch);
	}

	private function expression()
	{
		return $this->assignment();
	}

	private function assignment()
	{
		$expr = $this->or();

		if ($this->match(TokenType::TKN_EQUAL)) {
			$equals = $this->previous();
			$value = $this->assignment();

			if ($expr instanceof Variable) {
				$name = $expr->getName();
				return new Assign($name, $value);
			} else if ($expr instanceof Get) {
				return new Set($expr->getObject(), $expr->getName(), $value);
			}
		}

		return $expr;
	}

	private function or()
	{
		$expr = $this->and();

		while ($this->match(TokenType::TKN_OR)) {
			$operator = $this->previous();
			$right = $this->and();
			$expr = new Logical($expr, $operator, $right);
		}

		return $expr;
	}

	private function and()
	{
		$expr = $this->equality();

		while ($this->match(TokenType::TKN_AND)) {
			$operator = $this->previous();
			$right = $this->equality();
			$expr = new Logical($expr, $operator, $right);
		}

		return $expr;
	}

	private function equality()
	{
		$expr = $this->comparison();

		while ($this->match(TokenType::TKN_BANG_EQUAL, TokenType::TKN_EQUAL_EQUAL)) {
			$operator = $this->previous();
			$right = $this->comparison();
			$expr = new Binary($expr, $operator, $right);
		}

		return $expr;
	}

	private function comparison()
	{
		$expr = $this->addition();

		while ($this->match(TokenType::TKN_GREATER, TokenType::TKN_GREATER_EQUAL, TokenType::TKN_LESS, TokenType::TKN_LESS_EQUAL)) {
			$operator = $this->previous();
			$right = $this->addition();
			$expr = new Binary($expr, $operator, $right);
		}

		return $expr;
	}

	private function addition()
	{
		$expr = $this->multiplication();

		while ($this->match(TokenType::TKN_MINUS, TokenType::TKN_PLUS)) {
			$operator = $this->previous();
			$right = $this->multiplication();
			$expr = new Binary($expr, $operator, $right);
		}

		return $expr;
	}

	private function multiplication()
	{
		$expr = $this->unary();

		while ($this->match(TokenType::TKN_SLASH, TokenType::TKN_STAR)) {
			$operator = $this->previous();
			$right = $this->unary();
			$expr = new Binary($expr, $operator, $right);
		}

		return $expr;
	}

	private function unary()
	{
		if ($this->match(TokenType::TKN_MINUS, TokenType::TKN_BANG)) {
			$operator = $this->previous();
			$right = $this->unary();
			return new Unary($operator, $right);
		}

		return $this->call();
	}

	private function call()
	{
		$expr = $this->primary();

		while (true) {
			if ($this->match(TokenType::TKN_LEFT_PAREN)) {
				$expr = $this->finishCall($expr);
			} else if ($this->match(TokenType::TKN_DOT)) {
				$name = $this->consume(TokenType::TKN_IDENTIFIER, "Expect property name after '.'.");
				$expr = new Get($expr, $name);
			} else {
				break;
			}
		}

		return $expr;
	}

	private function finishCall(Expression $callee)
	{
		$arguments = [];

		if (!$this->check(TokenType::TKN_RIGHT_PAREN)) {
			do {
				if (count($arguments) >= FUNC_MAX_ARGS) {
					$this->error($this->peek(), "Cannot have more than 8 arguments.");
				}

				$arguments[] = $this->expression();
			} while ($this->match(TokenType::TKN_COMMA));
		}

		$paren = $this->consume(TokenType::TKN_RIGHT_PAREN, "Expect ')' after arguments.");

		return new Call($callee, $paren, $arguments);
	}

	private function primary()
	{
		if ($this->match(TokenType::TKN_FALSE)) return new Literal(false);
		if ($this->match(TokenType::TKN_TRUE)) return new Literal(true);
		if ($this->match(TokenType::TKN_NIL)) return new Literal(null);

		if ($this->match(TokenType::TKN_NUMBER, TokenType::TKN_STRING)) {
			return new Literal($this->previous()->literal);
		}

		if ($this->match(TokenType::TKN_SUPER)) {
			$keyword = $this->previous();
			$this->consume(TokenType::TKN_DOT, "Expect '.' after 'super'.");
			$method = $this->consume(TokenType::TKN_IDENTIFIER, "Expect superclass method name.");
			return new Super($keyword, $method);
		}

		if ($this->match(TokenType::TKN_THIS)) return new This($this->previous());

		if ($this->match(TokenType::TKN_IDENTIFIER)) {
			return new Variable($this->previous());
		}

		if ($this->match(TokenType::TKN_LEFT_PAREN)) {
			$expr = $this->expression();
			$this->consume(TokenType::TKN_RIGHT_PAREN, "Expect ')' after expression.");
			return new Grouping($expr);
		}

		throw $this->error($this->peek(), "Expect expression.");
	}

	private function consume($tokenType, $message)
	{
		if ($this->check($tokenType)) return $this->advance();

		throw $this->error($this->peek(), $message);
	}

	private function synchronize()
	{
		$this->advance();

		while (!$this->isAtEnd()) {
			if ($this->previous()->type == TokenType::TKN_SEMICOLON) return;

			switch ($this->peek()->type) {
				case TokenType::TKN_CLASS:
				case TokenType::TKN_FUN:
				case TokenType::TKN_VAR:
				case TokenType::TKN_FOR:
				case TokenType::TKN_IF:
				case TokenType::TKN_WHILE:
				case TokenType::TKN_PRINT:
				case TokenType::TKN_RETURN:
					return;
			}

			$this->advance();
		}
	}

	private function match( ...$tokenTypes)
	{
		foreach ($tokenTypes as $tokenType) {
			if ($this->check($tokenType)) {
				$this->advance();
				return true;
			}
		}

		return false;
	}

	private function check($tokenType)
	{
		if ($this->isAtEnd()) return false;
		return $this->peek()->type == $tokenType;
	}

	private function advance()
	{
		if (!$this->isAtEnd()) $this->current++;
		return $this->previous();
	}

	private function isAtEnd()
	{
		return $this->peek()->type == TokenType::TKN_EOF;
	}

	private function peek()
	{
		return $this->tokens[$this->current];
	}

	private function previous()
	{
		return $this->tokens[$this->current - 1];
	}

	private function error(Token $token, $message)
	{
		ErrorReporter::error($token, $message);

		return new \ParseError();
	}
}
