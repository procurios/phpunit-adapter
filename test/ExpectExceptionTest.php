<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test;

use Exception;
use InvalidArgumentException;
use PHPUnit_Framework_ExpectationFailedException;
use Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase;

/**
 * Make sure that the expectException* calls work
 */
class ExpectExceptionTest extends PhpunitAdapterTestCase
{
    public function testExpectException()
    {
        $this->expectException('InvalidArgumentException');
        throw new InvalidArgumentException();
    }

    public function letExpectExceptionFail()
    {
        $this->expectException('InvalidArgumentException');
        throw new Exception();
    }

    public function testExpectExceptionCode()
    {
        $code = mt_rand(1, 1000);
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionCode($code);
        throw new InvalidArgumentException('', $code);
    }

    public function testExpectExceptionCodeDoesNotExpectException()
    {
        $this->expectExceptionCode(123);
        $this->assertTrue(true);
    }

    public function letExpectExceptionCodeFail()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionCode(123);
        throw new InvalidArgumentException('', 321);
    }

    public function letExpectExceptionCodeFailWithOtherExpectations()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionCode(123);
        $this->expectExceptionMessage('foo');
        $this->expectExceptionMessageRegExp('(^foo$)');
        throw new InvalidArgumentException('foo', 321);
    }

    public function testExpectExceptionMessage()
    {
        $message = uniqid();
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage($message);
        throw new InvalidArgumentException($message);
    }

    public function testExpectExceptionMessageDoesNotExpectException()
    {
        $this->expectExceptionMessage('foo');
        $this->assertTrue(true);
    }

    public function letExpectExceptionMessageFail()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage('foo');
        throw new InvalidArgumentException('bar');
    }

    public function letExpectExceptionMessageFailWithOtherExpectations()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionCode(123);
        $this->expectExceptionMessage('foo');
        $this->expectExceptionMessageRegExp('(^bar$)');
        throw new InvalidArgumentException('bar', 123);
    }

    public function testExpectExceptionMessageRegExp()
    {
        $message = uniqid();
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessageRegExp('(^' . preg_quote($message) . '$)');
        throw new InvalidArgumentException($message);
    }

    public function testExpectExceptionMessageRegExpDoesNotExpectException()
    {
        $this->expectExceptionMessageRegExp('(^foo$)');
        $this->assertTrue(true);
    }

    public function letExpectExceptionMessageRegExpFail()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessageRegExp('(^foo$)');
        throw new InvalidArgumentException('bar');
    }

    public function letExpectExceptionMessageRegExpFailWithOtherExpectations()
    {
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionCode(123);
        $this->expectExceptionMessage('bar');
        $this->expectExceptionMessageRegExp('(^foo$)');
        throw new InvalidArgumentException('bar', 123);
    }

    /**
     * @dataProvider provideFailingMethods
     * @param string $failingMethod
     */
    public function testThatExpectExceptionMethodsCanFail($failingMethod)
    {
        try {
            $exceptionThrown = false;
            $testCase = new self($failingMethod);
            $testCase->runTest();
        } catch (PHPUnit_Framework_ExpectationFailedException $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

    public function provideFailingMethods()
    {
        return array(
            array('letExpectExceptionFail'),
            array('letExpectExceptionCodeFail'),
            array('letExpectExceptionCodeFailWithOtherExpectations'),
            array('letExpectExceptionMessageFail'),
            array('letExpectExceptionMessageFailWithOtherExpectations'),
            array('letExpectExceptionMessageRegExpFail'),
            array('letExpectExceptionMessageRegExpFailWithOtherExpectations'),
        );
    }
}
