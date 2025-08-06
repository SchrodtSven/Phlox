<?php

declare(strict_types=1);
/**
 * Abstract entity class for an expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-05
 */

namespace SchrodtSven\Phlox\Core\Expressions;

use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Core\Token;
use SchrodtSven\Phlox\Visitor;

class Set extends Expression
{
	public function __construct(private Expression $object, private Token $name, private Expression $value)
	{}

	public function accept(Visitor $visitor)
	{
		return $visitor->visitSetExpression($this);
	}
}
