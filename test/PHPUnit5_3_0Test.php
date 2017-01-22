<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test;

use Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase;

/**
 * Test features added in phpunit 5.3.0
 */
class PHPUnit5_3_0Test extends PhpunitAdapterTestCase
{
    /**
     * @requires PHPUnit < 4.0
     */
    public function testThatThisTestIsSkippedDueToRequirementsAnnotation()
    {
        $this->assertFalse(true, 'Requirement defined in @requires annotation is not parsed correctly');
    }
}
