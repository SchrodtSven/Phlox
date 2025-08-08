<?php

declare(strict_types=1);
/**
 * Unary expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Token;
use SchrodtSven\Phlox\ExprVisitor;

class Unary extends Expression
{
	public function __construct(private Token $operator, private Expression $right)
	{}

	public function accept(ExprVisitor $ExprVisitor)
	{
		return $ExprVisitor->visitUnaryExpression($this);
	}
}
