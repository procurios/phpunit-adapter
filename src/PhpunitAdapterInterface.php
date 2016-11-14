<?php
/**
 * © 2016 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use PHPUnit_Framework_Exception;

/**
 * Interface providing all available methods
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

    /**
     * @param mixed $exception
     * @param string $message
     * @param int|string $code
     *
     * @throws PHPUnit_Framework_Exception
     *
     * @since      Method available since Release 3.2.0
     * @deprecated Method deprecated since Release 5.2.0
     */
    public function setExpectedException($exception, $message = '', $code = null);

    # endregion
}
