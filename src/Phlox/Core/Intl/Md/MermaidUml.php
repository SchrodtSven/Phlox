<?php

declare(strict_types=1);
/**
 * Helper class for mardown mermaid UML diagrams
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phlox
 * @package Phlox
 * @version 0.1
 * @since 2025-08-08
 */

namespace SchrodtSven\Phlox\Core\Intl;

class MermaidUml
{
    // Visibilities 
    public const string PUB = '+'; // Public
    public const string PRV = '-'; // Private
    public const string PRT = '#'; // Protected
    public const string PKG  = '~'; // Package/Internal 

    // Relationships
    public const string REL_INH = '<|--'; //	Inheritance
    public const string REL_CMP = '*--'; //	Composition
    public const string REL_AGG = 'o--'; //	Aggregation
    public const string REL_ASS = '-->'; //	Association
    public const string REL_LNS = '--'; //Link (Solid)
    public const string REL_DPD = '.>'; //	Dependency
    public const string REL_REA = '..|>'; //	Realization
    public const string REL_LNK = '..'; //	Link (Dashed)
}
