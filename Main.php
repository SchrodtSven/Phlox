<?php
require_once 'src/Phlox/Autoload.php';

use SchrodtSven\Phlox\Core\Intl\Reflect;

$r = new Reflect();

$rc = $r->decribe($r->getFullPath('Statements', 'FunctionStmt'));
echo PHP_EOL;
var_dump($rc->getProperties()[0]->getType()->getName());
var_dump($rc->getProperties()[0]->getModifiers());


#\ReflectionProperty::