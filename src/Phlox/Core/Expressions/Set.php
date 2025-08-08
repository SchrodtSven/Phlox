<?php

declare(strict_types=1);
/**
 * Set expression
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

class Set extends Expression
{
	public function __construct(private Expression $object, private Token $name, private Expression $value)
	{}

	public function accept(ExprVisitor $ExprVisitor)
	{
		return $ExprVisitor->visitSetExpression($this);
	}
}
