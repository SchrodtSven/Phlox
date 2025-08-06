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

use SchrodtSven\Phlox\TokenType;

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
}
