<?php

declare(strict_types=1);
/**
 * Abstract entity class for an expression
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */

namespace SchrodtSven\Phlox\Core\Expressions;
use SchrodtSven\Phlox\ExprVisitor;

abstract class Expression
{
	abstract public function accept(ExprVisitor $ExprVisitor); //@todo adding type hint for ExprVisitor
}