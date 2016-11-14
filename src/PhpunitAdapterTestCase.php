<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use PHPUnit_Framework_TestCase;
use ReflectionClass;

$baseClass = 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_prior_5_2';

$reflectionClass = new ReflectionClass('PHPUnit_Framework_TestCase');
if ($reflectionClass->hasMethod('expectException')) {
    $baseClass = 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_2';
}

// Runtime definition of the PhpunitAdapter class
$classDefinition = 'namespace Procurios\TDD\PhpunitAdapter;class PhpunitAdapterTestCase extends \\' . $baseClass . ' {}';
eval($classDefinition);

if (false) {
    /**
     * Dummy class providing code completion in IDE's
     */
    class PhpunitAdapterTestCase extends PhpunitAdapterTestCase_prior_5_2
    {
    }
}
