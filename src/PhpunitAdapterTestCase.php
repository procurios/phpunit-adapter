<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use ReflectionClass;

$baseClass = null;

// Detect the version of PHPUnit we are running on by using class reflection
$reflectionClass = new ReflectionClass('PHPUnit_Framework_TestCase');
if ($reflectionClass->hasMethod('expectException')) {
    $baseClass = 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_2_0';
}

if ($reflectionClass->hasMethod('getMockWithoutInvokingTheOriginalConstructor')) {
    $baseClass = 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_0_0';
}

if ($baseClass !== null) {
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
    class PhpunitAdapterTestCase extends PhpunitAdapterTestCase_4_8_0
    {
    }
}
