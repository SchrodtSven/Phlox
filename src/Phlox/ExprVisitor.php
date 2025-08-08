<?php

declare(strict_types=1);
/**
 * Expression Visitor interface 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-06
 */


namespace SchrodtSven\Phlox;
use SchrodtSven\Phlox\Core\Expressions\Expression;
use SchrodtSven\Phlox\Core\Expressions\Assign;
use SchrodtSven\Phlox\Core\Expressions\Binary;
use SchrodtSven\Phlox\Core\Expressions\Call;
use SchrodtSven\Phlox\Core\Expressions\Get;
use SchrodtSven\Phlox\Core\Expressions\Grouping;
use SchrodtSven\Phlox\Core\Expressions\Super;
use SchrodtSven\Phlox\Core\Expressions\Literal;
use SchrodtSven\Phlox\Core\Expressions\Logical;
use SchrodtSven\Phlox\Core\Expressions\Set;
use SchrodtSven\Phlox\Core\Expressions\This;
use SchrodtSven\Phlox\Core\Expressions\Unary;
use SchrodtSven\Phlox\Core\Expressions\Variable;

interface ExprVisitor
{
	public function visitAssignExpression(Assign $expr);
	public function visitBinaryExpression(Binary $expr);
	public function visitCallExpression(Call $expr);
	public function visitGetExpression(Get $expr);
	public function visitGroupingExpression(Grouping $expr);
	public function visitLiteralExpression(Literal $expr);
	public function visitLogicalExpression(Logical $expr);
	public function visitSetExpression(Set $expr);
	public function visitSuperExpression(Super $expr);
	public function visitThisExpression(This $expr);
	public function visitUnaryExpression(Unary $expr);
	public function visitVariableExpression(Variable $expr);
}