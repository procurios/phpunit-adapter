<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test\helper;

use RuntimeException;

class ClassWithFailingConstructor
{
    /**
     * @throws RuntimeException
     */
    public function __construct()
    {
        throw new RuntimeException();
    }
}
