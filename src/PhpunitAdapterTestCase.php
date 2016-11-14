<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use ReflectionClass;

// Detect the version of PHPUnit we are running on by using class reflection
$reflectionClass = new ReflectionClass('PHPUnit_Framework_TestCase');
if ($reflectionClass->hasMethod('expectException')) {
    $baseClass = 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_2';
}

if (isset($baseClass)) {
    // Runtime definition of the PhpunitAdapterTestCase class
    $classDefinition = <<< PHP
namespace Procurios\TDD\PhpunitAdapter;
class PhpunitAdapterTestCase extends \\$baseClass
{
}
PHP;

    eval($classDefinition);
}

if (!class_exists('Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase', false)) {
    /**
     * Fall back on extending the most complete compatibility layer
     */
    class PhpunitAdapterTestCase extends PhpunitAdapterTestCase_prior_5_2
    {
    }
}
