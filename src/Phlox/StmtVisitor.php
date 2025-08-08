<?php

declare(strict_types=1);
/**
 * Statement Visitor interface 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */


namespace SchrodtSven\Phlox;
use SchrodtSven\Phlox\Core\Statements\BlockStmt;
use SchrodtSven\Phlox\Core\Statements\ClassStmt;
use SchrodtSven\Phlox\Core\Statements\ExpressionStmt;
use SchrodtSven\Phlox\Core\Statements\FunctionStmt;
use SchrodtSven\Phlox\Core\Statements\IfStmt;
use SchrodtSven\Phlox\Core\Statements\PrintStmt;
use SchrodtSven\Phlox\Core\Statements\ReturnStmt;
use SchrodtSven\Phlox\Core\Statements\VarStmt;
use SchrodtSven\Phlox\Core\Statements\WhileStmt;



interface StmtVisitor
{
	public function visitBlockStatement(BlockStmt  $stmt);
	public function visitClassStatement(ClassStmt  $stmt);
	public function visitExpressionStatement(ExpressionStmt  $stmt);
	public function visitFunctionStatement(FunctionStmt  $stmt);
	public function visitIfStatement(IfStmt  $stmt);
	public function visitPrintStatement(PrintStmt  $stmt);
	public function visitReturnStatement(ReturnStmt  $stmt);
	public function visitVarStatement(VarStmt  $stmt);
	public function visitWhileStatement(WhileStmt  $stmt);
}