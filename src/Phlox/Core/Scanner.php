<?php

declare(strict_types=1);
/**
 * Scanner class
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */


namespace SchrodtSven\Phlox\Core;

use SchrodtSven\Phlox\Token;
use SchrodtSven\Phlox\TokenType;
use SchrodtSven\Phlox\Core\ErrorReporter;
class Scanner
{
	private array $tokens = [];
	private int $start = 0;
	private int $current = 0;
	private int $line = 1;

	private static $keywords = [
		'and'	=> TokenType::TKN_AND,
		'class'	=> TokenType::TKN_CLASS,
		'else'	=> TokenType::TKN_ELSE,
		'false'	=> TokenType::TKN_FALSE,
		'for'	=> TokenType::TKN_FOR,
		'fun'	=> TokenType::TKN_FUN,
		'if'	=> TokenType::TKN_IF,
		'nil'	=> TokenType::TKN_NIL,
		'or'	=> TokenType::TKN_OR,
		'print'	=> TokenType::TKN_PRINT,
		'return'=> TokenType::TKN_RETURN,
		'super'	=> TokenType::TKN_SUPER,
		'this'	=> TokenType::TKN_THIS,
		'true'	=> TokenType::TKN_TRUE,
		'var'	=> TokenType::TKN_VAR,
		'while' => TokenType::TKN_WHILE
	];
   
    public function __construct(private string $source) {}


    private function scanToken()
	{
		$c = $this->advance();
		switch ($c) {
			case '(': $this->addToken(TokenType::TKN_LEFT_PAREN); break;
			case ')': $this->addToken(TokenType::TKN_RIGHT_PAREN); break;
			case '{': $this->addToken(TokenType::TKN_LEFT_BRACE); break;
			case '}': $this->addToken(TokenType::TKN_RIGHT_BRACE); break;
			case ',': $this->addToken(TokenType::TKN_COMMA); break;
			case '.': $this->addToken(TokenType::TKN_DOT); break;
			case '-': $this->addToken(TokenType::TKN_MINUS); break;
			case '+': $this->addToken(TokenType::TKN_PLUS); break;
			case ';': $this->addToken(TokenType::TKN_SEMICOLON); break;
			case '*': $this->addToken(TokenType::TKN_STAR); break;

			case '!': $this->addToken($this->match('=') ? TokenType::TKN_BANG_EQUAL : TokenType::TKN_BANG); break;
			case '=': $this->addToken($this->match('=') ? TokenType::TKN_EQUAL_EQUAL : TokenType::TKN_EQUAL); break;
			case '<': $this->addToken($this->match('=') ? TokenType::TKN_LESS_EQUAL : TokenType::TKN_LESS); break;
			case '>': $this->addToken($this->match('=') ? TokenType::TKN_GREATER_EQUAL : TokenType::TKN_GREATER); break;

			case '/':
				if ($this->match('/'))
				{
					// A comment goes until the end of the line.
					while ($this->peek() != "\n" && !$this->isAtEnd()) $this->advance();
				}
				else
				{
					$this->addToken(TokenType::TKN_SLASH);
				}
				break;

			case ' ':
			case "\r":
			case "\t":
				// Ignore whitespace.
				break;

			case "\n":
				$this->line++;
				break;

			case '"': $this->string(); break;

			default:
				if ($this->isDigit($c))
				{
					$this->number();
				}
				else if ($this->isAlpha($c))
				{
					$this->identifier();
				}
				else
				{
					ErrorReporter::error($this->line, "Unexpected character '$c'.");
				}
		}
	}

	private function advance()
	{
		$this->current++;
		return $this->source[$this->current - 1];
	}

	private function addToken($type, $literal = null)
	{
		if ($literal === null) $literal = (string)$type;
		$this->tokens[] = new Token($type, $literal, $this->line);
	}

	private function match($expected) {
		if ($this->isAtEnd()) return false;
		if ($this->source[$this->current] != $expected) return false;

		$this->current++;
		return true;
	}

	private function peek() {
		if ($this->isAtEnd()) return '\0';
		return $this->source[$this->current];
	}

	private function string()
	{
		while ($this->peek() != '"' && !$this->isAtEnd())
		{
			if ($this->peek() == '\n') $this->line++;
			$this->advance();
		}

		// Unterminated string.
		if ($this->isAtEnd())
		{
			ErrorReporter::error($this->line, "Unterminated string.");
			return;
		}

		// The closing ".
		$this->advance();

		// Trim the surrounding quotes.
		$value = substr($this->source, $this->start + 1, $this->current - $this->start - 2);
		$this->addToken(TokenType::TKN_STRING, $value);
	}

	private function isDigit($c)
	{
		return $c >= '0' && $c <= '9';
	}

	private function number()
	{
		while ($this->isDigit($this->peek())) $this->advance();

		// Look for a fractional part.
		if ($this->peek() == '.' && $this->isDigit($this->peekNext()))
		{
			// Consume the "."
			$this->advance();

			while ($this->isDigit($this->peek())) $this->advance();
		}

		$this->addToken(TokenType::TKN_NUMBER, floatval(substr($this->source, $this->start, $this->current - $this->start)));
	}

	private function peekNext()
	{
		if ($this->current + 1 >= strlen($this->source)) return '\0';
		return $this->source[$this->current + 1];
	}

	private function identifier()
	{
		while ($this->isAlphaNumeric($this->peek())) $this->advance();

		$type = TokenType::TKN_IDENTIFIER;
		$str = substr($this->source, $this->start, $this->current - $this->start);
		if (isset(self::$keywords[$str]))
		{
			$type = self::$keywords[$str];
		}

		$this->addToken($type, $str);
	}

	private function isAlpha($c)
	{
		return ($c >= 'a' && $c <= 'z') || ($c >= 'A' && $c <= 'Z') || $c == '_';
	}

	private function isAlphaNumeric($c)
	{
		return $this->isAlpha($c) || $this->isDigit($c);
	}

    	public function scanTokens()
	{
		while (!$this->isAtEnd())
		{
			$this->start = $this->current;
			$this->scanToken();
		}

		$this->tokens[] = new Token(null, TokenType::TKN_EOF,  $this->line);

		return $this->tokens;
	}

	private function isAtEnd()
	{
		return $this->current >= strlen($this->source);
	}
}
