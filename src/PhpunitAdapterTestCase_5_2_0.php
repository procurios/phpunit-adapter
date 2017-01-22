<?php
/**
 * © 2017 Procurios
 */
namespace Procurios\TDD\PhpunitAdapter;

use PHPUnit_Runner_Version;
use ReflectionObject;

/**
 * Compatibility layer for running phpunit 5.2.0
 */
abstract class PhpunitAdapterTestCase_5_2_0 extends PhpunitAdapterTestCase_5_3_0
{
    /**
     * Method body is largely copied from the getMissingRequirements and getRequirements methods in phpunit 5.3.0
     * @before
     */
    protected function procuriosAdapterCheckRequirements()
    {
        static
            $REGEX_REQUIRES_VERSION = '/@requires\s+(?P<name>PHP(?:Unit)?)\s+(?P<operator>[<>=!]{0,2})\s*(?P<version>[\d\.-]+(dev|(RC|alpha|beta)[\d\.])?)[ \t]*\r?$/m',
            $REGEX_REQUIRES = '/@requires\s+(?P<name>function|extension)\s+(?P<value>([^ ]+?))\s*(?P<operator>[<>=!]{0,2})\s*(?P<version>[\d\.-]+[\d\.]?)?[ \t]*\r?$/m'
        ;

        $reflector = new ReflectionObject($this);
        $docComment = $reflector->getDocComment();
        $reflector = $reflector->getMethod($this->getName(false));
        $docComment .= "\n" . $reflector->getDocComment();
        $requires = array();

        if ($count = preg_match_all($REGEX_REQUIRES_VERSION, $docComment, $matches)) {
            for ($i = 0; $i < $count; $i++) {
                $requires[$matches['name'][$i]] = array(
                    'version' => $matches['version'][$i],
                    'operator' => $matches['operator'][$i]
                );
            }
        }

        $matches = array();

        if ($count = preg_match_all($REGEX_REQUIRES, $docComment, $matches)) {
            for ($i = 0; $i < $count; $i++) {
                $name = $matches['name'][$i] . 's';
                if (!isset($requires[$name])) {
                    $requires[$name] = array();
                }
                $requires[$name][] = $matches['value'][$i];
                if (empty($matches['version'][$i]) || $name != 'extensions') {
                    continue;
                }
                $requires['extension_versions'][$matches['value'][$i]] = array(
                    'version' => $matches['version'][$i],
                    'operator' => $matches['operator'][$i]
                );
            }
        }

        $missing = array();

        $operator = empty($requires['PHP']['operator']) ? '>=' : $requires['PHP']['operator'];
        if (!empty($requires['PHP']) && !version_compare(PHP_VERSION, $requires['PHP']['version'], $operator)) {
            $missing[] = sprintf('PHP %s %s is required.', $operator, $requires['PHP']['version']);
        }

        if (!empty($requires['PHPUnit'])) {
            $phpunitVersion = PHPUnit_Runner_Version::id();

            $operator = empty($requires['PHPUnit']['operator']) ? '>=' : $requires['PHPUnit']['operator'];
            if (!version_compare($phpunitVersion, $requires['PHPUnit']['version'], $operator)) {
                $missing[] = sprintf('PHPUnit %s %s is required.', $operator, $requires['PHPUnit']['version']);
            }
        }

        if (!empty($requires['functions'])) {
            foreach ($requires['functions'] as $function) {
                $pieces = explode('::', $function);
                if (2 === count($pieces) && method_exists($pieces[0], $pieces[1])) {
                    continue;
                }
                if (function_exists($function)) {
                    continue;
                }
                $missing[] = sprintf('Function %s is required.', $function);
            }
        }

        if (!empty($requires['extensions'])) {
            foreach ($requires['extensions'] as $extension) {
                if (isset($requires['extension_versions'][$extension])) {
                    continue;
                }
                if (!extension_loaded($extension)) {
                    $missing[] = sprintf('Extension %s is required.', $extension);
                }
            }
        }

        if (!empty($requires['extension_versions'])) {
            foreach ($requires['extension_versions'] as $extension => $requires) {
                $actualVersion = phpversion($extension);

                $operator = empty($requires['operator']) ? '>=' : $requires['operator'];
                if (false === $actualVersion || !version_compare($actualVersion, $requires['version'], $operator)) {
                    $missing[] = sprintf(
                        'Extension %s %s %s is required.',
                        $extension,
                        $operator,
                        $requires['version']
                    );
                }
            }
        }

        if (!empty($missing)) {
            $this->markTestSkipped(implode(PHP_EOL, $missing));
        }
    }
}
