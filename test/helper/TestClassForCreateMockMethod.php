<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test\helper;

use RuntimeException;

/**
 * Class with characteristics needed to test the createMock method introduced in PHPUnit 5.4.0
 */
class TestClassForCreateMockMethod
{
    public function __construct()
    {
        throw new RuntimeException('Original constructor should be disabled');
    }

    public function __clone()
    {
        throw new RuntimeException('Original clone constructor should be disabled');
    }

    /**
     * @param mixed $bar
     */
    public function foo($bar)
    {
    }
}
