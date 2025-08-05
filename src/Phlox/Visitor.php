<?php

declare(strict_types=1);
/**
 * Visitor interface 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-05
 */


namespace SchrodtSven\Phlox;

interface Visitor
{
	public function visitAssignExpression(AssignExpression $expr);
	public function visitBinaryExpression(BinaryExpression $expr);
	public function visitCallExpression(CallExpression $expr);
	public function visitGetExpression(GetExpression $expr);
	public function visitGroupingExpression(GroupingExpression $expr);
	public function visitLiteralExpression(LiteralExpression $expr);
	public function visitLogicalExpression(LogicalExpression $expr);
	public function visitSetExpression(SetExpression $expr);
	public function visitSuperExpression(SuperExpression $expr);
	public function visitThisExpression(ThisExpression $expr);
	public function visitUnaryExpression(UnaryExpression $expr);
	public function visitVariableExpression(VariableExpression $expr);
}