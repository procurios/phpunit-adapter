<?php
/**
 * © 2017 Procurios
 */
namespace PHPUnit\Framework {

    use PHPUnit_Framework_TestCase;

    if (!class_exists('PHPUnit\Framework\TestCase', true)) {
        /**
         * Add namespaced TestCase alias as introduced in PHPUnit 5.4.0
         */
        class TestCase extends PHPUnit_Framework_TestCase
        {
        }
    }
}

namespace Procurios\TDD\PhpunitAdapter {

    use PHPUnit_Framework_MockObject_RuntimeException;

    /**
     * Compatibility layer for running phpunit 5.3.0
     */
    abstract class PhpunitAdapterTestCase_5_3_0 extends PhpunitAdapterTestCase_5_4_0
    {
        protected function createMock($className)
        {
            if (!class_exists($className, true) && !interface_exists($className, true)) {
                throw new PHPUnit_Framework_MockObject_RuntimeException(
                    sprintf(
                        'Cannot stub or mock class or interface "%s" which does not exist',
                        $className
                    )
                );
            }

            return $this->getMockBuilder($className)
                ->disableOriginalConstructor()
                ->disableOriginalClone()
                ->disableArgumentCloning()
                ->getMock()
                ;
        }
    }

}
