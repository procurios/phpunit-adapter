<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_MockObject_RuntimeException;
use Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase;
use stdClass;

/**
 * Test features added in phpunit 5.4.0
 */
class PHPUnit5_4_0Test extends PhpunitAdapterTestCase
{
    public function testThatCreateMockAppliesCorrectConfiguration()
    {
        $foo = new stdClass();

        $className = 'Procurios\TDD\PhpunitAdapter\test\helper\TestClassForCreateMockMethod';

        /** @var PHPUnit_Framework_MockObject_MockObject|helper\TestClassForCreateMockMethod $mock */
        $mock = $this->createMock($className);
        $mock->expects($this->once())
            ->method('foo')
            ->with($this->identicalTo($foo))
        ;

        $mock->foo($foo);

        $mockClone = clone $mock;
    }

    public function testThatMockingOfUnknownTypesIsNotAllowedWithCreateMock()
    {
        $exceptionThrown = false;
        try {
            $this->createMock('Procurios\TDD\PhpunitAdapter\test\helper\NonExistingTestClassForCreateMockMethod');
        } catch (PHPUnit_Framework_MockObject_RuntimeException $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown, 'Mocking unknown types should not be allowed');
    }
}
