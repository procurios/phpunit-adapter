<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test;

use Exception;
use InvalidArgumentException;

/**
 * Test features added in phpunit 5.2.0
 */
class PHPUnit5_2_0Test extends PhpunitAdapterTestCaseWithFailingMethods
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
}
