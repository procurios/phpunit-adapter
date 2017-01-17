<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test;

use PHPUnit_Framework_ExpectationFailedException;
use Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase;
use ReflectionObject;

/**
 *
 */
abstract class PhpunitAdapterTestCaseWithFailingMethods extends PhpunitAdapterTestCase
{
    /**
     * @dataProvider provideFailingMethods
     * @param string $failingMethod
     */
    public function testThatAssertionsCanFail($failingMethod)
    {
        try {
            $exceptionThrown = false;
            $testCase = new static($failingMethod);
            $testCase->runTest();
        } catch (PHPUnit_Framework_ExpectationFailedException $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

    /**
     * @return array
     */
    public function provideFailingMethods()
    {
        $failingMethods = array();

        $reflectionObject = new ReflectionObject($this);
        foreach ($reflectionObject->getMethods() as $reflectionMethod) {
            if (preg_match('(^let.*?Fail)', $reflectionMethod->getName())) {
                $failingMethods[] = array($reflectionMethod->getName());
            }
        }

        return $failingMethods;
    }
}
