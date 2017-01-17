<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter\test;

/**
 * Test features added in phpunit 5.0.0
 */
class PHPUnit5_0_0Test extends PhpunitAdapterTestCaseWithFailingMethods
{
    public function testGetMockWithoutInvokingTheOriginalConstructor()
    {
        $className = 'Procurios\TDD\PhpunitAdapter\test\helper\ClassWithFailingConstructor';
        $mock = $this->getMockWithoutInvokingTheOriginalConstructor($className);
        $this->assertInstanceOf($className, $mock);
    }

    public function testAssertFinite()
    {
        $this->assertFinite(123);
    }

    public function letAssertFiniteFailForInfiniteNumbers()
    {
        $this->assertFinite(INF);
    }

    public function testAssertInfinite()
    {
        $this->assertInfinite(INF);
    }

    public function letAssertInfiniteFailForFiniteNumbers()
    {
        $this->assertInfinite(123);
    }

    public function testAssertNan()
    {
        $this->assertNan(NAN);
    }

    public function letAssertNanFailForNumbers()
    {
        $this->assertNan(123);
    }
}
