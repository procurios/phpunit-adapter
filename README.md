# phpunit-adapter
When new features come available in [PHPUnit](https://phpunit.de/) you will not always be able to use them directly
due to several possible reasons.

When you do want to use these new features, but your tests need to be able to run on older versions of PHPUnit
(e.g. because of older supported PHP versions) this compatibility package might come in handy. It aims to implement
new features of PHPUnit supporting older versions.

## Usage
Instead of extending the `PHPUnit_Framework_TestCase` class, you'ld simply extend the `Procurios\TDD\PhpunitAdapter\PhpunitAdapterTestCase` class and you're done!

## Features
Below you'll find a list of features this package provides per PHPUnit version you run this package on.

### PHPUnit >= 5.2.0
No changes applied, extending the `PhpunitAdapterTestCase` is the same as extending `PHPUnit_Framework_TestCase` directly.

### PHPUnit < 5.2.0
**Added**
- `expectException`
- `expectExceptionCode`
- `expectExceptionMessage`
- `expectExceptionMessageRegExp`

**Deprecated**
- `setExpectedException`
