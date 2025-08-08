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


namespace SchrodtSven\Phlox\Core;

enum TokenType: string
{
    case TKN_LEFT_PAREN  =   'TKN_LEFT_PAREN';
    case TKN_RIGHT_PAREN =     'TKN_RIGHT_PAREN';
    case TKN_LEFT_BRACE  =   'TKN_LEFT_BRACE';
    case TKN_RIGHT_BRACE =     'TKN_RIGHT_BRACE';
    case TKN_COMMA =         'TKN_COMMA';
    case TKN_DOT =           'TKN_DOT';
    case TKN_MINUS =         'TKN_MINUS';
    case TKN_PLUS =          'TKN_PLUS';
    case TKN_SEMICOLON =     'TKN_SEMICOLON';
    case TKN_SLASH =         'TKN_SLASH';
    case TKN_STAR =          'TKN_STAR';
    case TKN_BANG =          'TKN_BANG';
    case TKN_BANG_EQUAL  =   'TKN_BANG_EQUAL';
    case TKN_EQUAL =         'TKN_EQUAL';
    case TKN_EQUAL_EQUAL =     'TKN_EQUAL_EQUAL';
    case TKN_GREATER =       'TKN_GREATER';
    case TKN_GREATER_EQUAL  =    'TKN_GREATER_EQUAL';
    case TKN_LESS =          'TKN_LESS';
    case TKN_LESS_EQUAL  =   'TKN_LESS_EQUAL';
    case TKN_IDENTIFIER  =   'TKN_IDENTIFIER';
    case TKN_STRING =        'TKN_STRING';
    case TKN_NUMBER =        'TKN_NUMBER';
    case TKN_AND =           'TKN_AND';
    case TKN_CLASS =         'TKN_CLASS';
    case TKN_ELSE =          'TKN_ELSE';
    case TKN_FALSE =         'TKN_FALSE';
    case TKN_FUN =           'TKN_FUN';
    case TKN_FOR =           'TKN_FOR';
    case TKN_IF =            'TKN_IF';
    case TKN_NIL =           'TKN_NIL';
    case TKN_OR =            'TKN_OR';
    case TKN_PRINT =         'TKN_PRINT';
    case TKN_RETURN =        'TKN_RETURN';
    case TKN_SUPER =         'TKN_SUPER';
    case TKN_THIS =          'TKN_THIS';
    case TKN_TRUE =          'TKN_TRUE';
    case TKN_VAR =           'TKN_VAR';
    case TKN_WHILE =         'TKN_WHILE';
    case TKN_EOF =           'TKN_EOF';
}
