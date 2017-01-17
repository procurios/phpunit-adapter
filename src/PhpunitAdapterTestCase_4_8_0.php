<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

/**
 * Adapter for phpunit 4.8.0
 */
class PhpunitAdapterTestCase_4_8_0 extends PhpunitAdapterTestCase_5_0_0
{
    /**
     * @param string $originalClassName
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    public function getMockWithoutInvokingTheOriginalConstructor($originalClassName)
    {
        return $this->getMockBuilder($originalClassName)
            ->disableOriginalConstructor()
            ->getMock()
            ;
    }

    /**
     * Asserts that a variable is finite.
     *
     * @param mixed $actual
     * @param string $message
     */
    public static function assertFinite($actual, $message = '')
    {
        self::assertTrue(is_finite($actual), $message);
    }

    /**
     * Asserts that a variable is infinite.
     *
     * @param mixed $actual
     * @param string $message
     */
    public static function assertInfinite($actual, $message = '')
    {
        self::assertTrue(is_infinite($actual), $message);
    }

    /**
     * Asserts that a variable is nan.
     *
     * @param mixed $actual
     * @param string $message
     */
    public static function assertNan($actual, $message = '')
    {
        self::assertTrue(is_nan($actual), $message);
    }
}
