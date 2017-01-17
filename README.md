# phpunit-adapter
[![Build Status](https://travis-ci.org/procurios/phpunit-adapter.svg?branch=master)](https://travis-ci.org/procurios/phpunit-adapter)

When new features come available in [PHPUnit](https://phpunit.de/) you will not always be able to use them directly
due to several possible reasons.

When you do want to use these new features, but your tests need to be able to run on older versions of PHPUnit
(e.g. because of older supported PHP versions) this compatibility package might come in handy. It aims to implement
new features of PHPUnit supporting older versions.

## Usage
Instead of extending the `PHPUnit_Framework_TestCase` class, you'ld simply extend the `Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase` class and you're done!

## Features
This package only extends the `PHPUnit_Framework_TestCase` class. You will be able to use any method available in phpunit 5.2.0.
