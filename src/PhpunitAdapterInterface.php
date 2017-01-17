<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use PHPUnit_Framework_Exception;

/**
 * Interface providing all methods extended in the adapter classes
 */
interface PhpunitAdapterInterface
{
    # region Changes in PHPUnit 5.2.0

    /**
     * @param string $exception
     *
     * @since Method available since Release 5.2.0
     */
    public function expectException($exception);

    /**
     * @param int|string $code
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 5.2.0
     */
    public function expectExceptionCode($code);

    /**
     * @param string $message
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 5.2.0
     */
    public function expectExceptionMessage($message);

    /**
     * @param string $messageRegExp
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since Method available since Release 5.2.0
     */
    public function expectExceptionMessageRegExp($messageRegExp);

    # endregion

    # region Changes in PHPUnit 5.0.0

    /**
     * Asserts that a variable is finite.
     *
     * @param mixed $actual
     * @param string $message
     */
    public static function assertFinite($actual, $message = '');

    /**
     * Asserts that a variable is infinite.
     *
     * @param mixed $actual
     * @param string $message
     */
    public static function assertInfinite($actual, $message = '');

    /**
     * Asserts that a variable is nan.
     *
     * @param mixed $actual
     * @param string $message
     */
    public static function assertNan($actual, $message = '');

    # endregion
}
