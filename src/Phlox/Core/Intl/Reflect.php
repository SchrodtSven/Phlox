<?php

declare(strict_types=1);
/**
 * Helper classes for PHP's native \Reflection API
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */

namespace SchrodtSven\Phlox\Core\Intl;
class Reflect 
{
    private const string NS_TPL = 'SchrodtSven\Phlox\Core\%s\%s';

    private const string SFX =  '.php';

    public function decribe(string $fqcn)
    {
        #$foo = new $fqcn;
        $refl = new \ReflectionClass($fqcn);

        return $refl;
    }

    public function getFullPath(string $subNs, string $class)
    {
        return sprintf(self::NS_TPL, $subNs, $class);
    }



}