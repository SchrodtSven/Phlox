<?php

declare(strict_types=1);
/**
 * Enumeration of token types
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-05
 */


namespace SchrodtSven\Phlox;

enum TokenType
{
    case TKN_LEFT_PAREN;
    case TKN_RIGHT_PAREN;
    case TKN_LEFT_BRACE;
    case TKN_RIGHT_BRACE;
    case TKN_COMMA;
    case TKN_DOT;
    case TKN_MINUS;
    case TKN_PLUS;
    case TKN_SEMICOLON;
    case TKN_SLASH;
    case TKN_STAR;
    case TKN_BANG;
    case TKN_BANG_EQUAL;
    case TKN_EQUAL;
    case TKN_EQUAL_EQUAL;
    case TKN_GREATER;
    case TKN_GREATER_EQUAL;
    case TKN_LESS;
    case TKN_LESS_EQUAL;
    case TKN_IDENTIFIER;
    case TKN_STRING;
    case TKN_NUMBER;
    case TKN_AND;
    case TKN_CLASS;
    case TKN_ELSE;
    case TKN_FALSE;
    case TKN_FUN;
    case TKN_FOR;
    case TKN_IF;
    case TKN_NIL;
    case TKN_OR;
    case TKN_PRINT;
    case TKN_RETURN;
    case TKN_SUPER;
    case TKN_THIS;
    case TKN_TRUE;
    case TKN_VAR;
    case TKN_WHILE;
    case TKN_EOF;
}