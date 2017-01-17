<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use Exception;
use PHPUnit_Util_InvalidArgumentHelper;

/**
 * Adapter for phpunit 5.0.0
 */
abstract class PhpunitAdapterTestCase_5_0_0 extends PhpunitAdapterTestCase_5_2_0
{
    private $adaptExceptionClass;
    private $adaptExceptionCode;
    private $adaptExceptionMessage = '';
    private $adaptExceptionRegExp;
    private $adaptRealMethodName;

    /**
     * @inheritdoc
     */
    public function expectException($exception)
    {
        if (!is_string($exception)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->adaptExceptionClass = $exception;
        $this->adaptUpdateExpectedException();
    }

    /**
     * @inheritdoc
     */
    public function expectExceptionCode($code)
    {
        if (!is_int($code) && !is_string($code)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer or string');
        }

        $this->adaptExceptionCode = $code;
        $this->adaptUpdateExpectedException();
    }

    /**
     * @inheritdoc
     */
    public function expectExceptionMessage($message)
    {
        if (!is_string($message)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->adaptExceptionMessage = $message;
        $this->adaptUpdateExpectedException();
    }

    /**
     * @inheritdoc
     */
    public function expectExceptionMessageRegExp($messageRegExp)
    {
        if (!is_string($messageRegExp)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->adaptExceptionRegExp = $messageRegExp;
        $this->adaptUpdateExpectedException();
    }

    /**
     * @inheritdoc
     * @deprecated Method deprecated since Release 5.2.0
     */
    public function setExpectedException($exception, $message = '', $code = null)
    {
        parent::setExpectedException($exception, $message, $code);
    }

    private function adaptUpdateExpectedException()
    {
        if ($this->adaptExceptionClass !== null) {
            $this->setExpectedException(
                $this->adaptExceptionClass,
                $this->adaptExceptionMessage,
                $this->adaptExceptionCode
            );
        }
    }

    /**
     * @inheritdoc
     */
    protected function runTest()
    {
        $name = $this->getName(false);
        if (!is_null($name)) {
            // Defer the test method execution to the test wrapper
            $this->setName('procuriosAdapterTestWrapper');
            $this->adaptRealMethodName = $name;
        }

        return parent::runTest();
    }

    public function procuriosAdapterTestWrapper()
    {
        // Restore real method name for messages
        $this->setName($this->adaptRealMethodName);

        try {
            return call_user_func_array(array($this, $this->adaptRealMethodName), func_get_args());
        } catch (Exception $e) {
            if ($this->adaptExceptionRegExp !== null) {
                $this->assertRegExp($this->adaptExceptionRegExp, $e->getMessage());
            }

            throw $e;
        }
    }
}
