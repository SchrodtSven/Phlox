<?php

declare(strict_types=1);
/**
 * Error reporting class
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */


namespace SchrodtSven\Phlox\Core;

use SchrodtSven\Phlox\TokenType;
use SchrodtSven\Phlox\Token;
class ErrorReporter
{

    public static $hadError = false;
	public static $hadRuntimeError = false;

	public static function error($lineOrTkn, $message)
	{
		if ($$lineOrTkn instanceof Token)
		{
			$token = $lineOrTkn;
			if ($token->getType() == TokenType::TKN_EOF)
			{
				self::report($token->getLine(), " at end", $message);
			}
			else
			{
				self::report($token->getLine(), " at '" . $token->getLiteral() . "'", $message);
			}
		}
		else
		{
			$line = $lineOrTkn;
			self::report($line, '', $message);
		}
	}

	public static function report($line, $where, $message)
	{
		print("[line $line] Error$where: $message\n");
		self::$hadError = true;
	}

	public static function runtimeError(\RuntimeError $error)
	{
		print("[line " . $error->token->line . "] " . $error->getMessage() . "\n");
		self::$hadRuntimeError = true;
	}

	public static function warning($message)
	{
		print("WARNING: " . $message . "\n");
	}
}
