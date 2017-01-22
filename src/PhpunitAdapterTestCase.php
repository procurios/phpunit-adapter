<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use PHPUnit_Runner_Version;

/**
 * Detect the version of PHPUnit we are running on by using class reflection
 * @return null|string
 */
function detectBaseClass()
{
    if (!class_exists('PHPUnit_Runner_Version')) {
        return null;
    }

    $phpunitVersion = PHPUnit_Runner_Version::id();
    if (version_compare($phpunitVersion, '5.3', '>=')) {
        return 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_3_0';
    }

    if (version_compare($phpunitVersion, '5.2', '>=')) {
        return 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_2_0';
    }

    if (version_compare($phpunitVersion, '5.0', '>=')) {
        return 'Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase_5_0_0';
    }

    return null;
}

$baseClass = detectBaseClass();

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
