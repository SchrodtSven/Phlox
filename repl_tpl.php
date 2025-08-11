<?php

declare(strict_types=1);
/**
 * Tiny template for an REPL environment 
 * - just awfully hacked prototype, not even a POC
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-11
 */
class Repl
{
    private float $version = 0.9;
    private string $name = 'Phlox REPL version ';
    private string $welc = '*** %s Welcome user ***';
    private string $prmt = '> ';
    private array $grmr = ['QUIT', 'DATE', 'HELP', 'NOW', 'BYE'];

    // modes defining how to react on user's input on prompt
    private const array REPL_MODE  = ['dft', 'mrr', 'rot'];
    private string $crtMode = 'rot';
    private const string  EXIT = 'BYE';
    private const string  TIN = 'The time is now: ';

    private const int MAX_INP_BUFF = 1024;

    public function __construct()
    {
        echo implode(PHP_EOL, [
            sprintf($this->welc, $this->name . $this->version),
            $this->now(),
            $this->prmt
        ]);
    }

    public function loop(): void
    {
        while (true) {
            $inp = trim(fread(STDIN, self::MAX_INP_BUFF));
            $this->printLn($this->parseInput($inp));
           echo $this->prmt;
            if ($inp === self::EXIT) {
                exit(0);
            }
        }
    }

    private function printLn(string $txt): void
    {
        echo $txt . PHP_EOL;
    }

    private function parseInput(string $inp): string
    {
        if (!in_array($inp, $this->grmr))
            return ('Parse error - unknown command');

        if (in_array($inp, ['NOW', 'DATE'])) {
            return $this->now(false);
        } else {
            return PHP_EOL . "[ROT:] " . str_rot13(trim($inp)) . PHP_EOL;
        }
    }

    private function now(bool $prol = true): string
    {
        return ($prol)
            ? self::TIN . date('Y-m-d H:i:s')
            : date('Y-m-d H:i:s');
    }
}
(new Repl)->loop();
