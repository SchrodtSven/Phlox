<?php

declare(strict_types=1);
/**
 * Entity class for token(s)
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-05
 */


namespace SchrodtSven\Phlox\Core;

use SchrodtSven\Phlox\Core\TokenType;

class Token
{

    /**
     * Constructor function - just setting private attributes
     */
    public function __construct(
        private string|TokenType|null $literal = null,
        private mixed  $type = TokenType::TKN_EOF,
        private int $line = 0
    ) {}

    /**
     * Get the value of line
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set the value of line
     *
     * @return  self
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get the value of literal
     */
    public function getLiteral()
    {
        return $this->literal;
    }

    /**
     * Set the value of literal
     *
     * @return  self
     */
    public function setLiteral($literal)
    {
        $this->literal = $literal;

        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function __toString(): string
    {
        $str = "{$this->type}";
        if (!is_null($this->literal))
            $str .= " ({$this->literal})";
        return $str;
    }
}
