# WFV Unit Testing
[![Build Status](https://travis-ci.org/macder/wp-form-validation.svg?branch=master)](https://travis-ci.org/macder/wp-form-validation)


## Support:
**PHP:** 5.4, 5.5, 5.6, 7.0<br>
**WordPress:** 4.x.x including multisite

**Lowest Pass:**<br>
[0.8.10](https://github.com/macder/wp-form-validation/tree/0.8.10) is [passing](https://travis-ci.org/macder/wp-form-validation/builds/223375921) on WordPress 3.7 / PHP 5.4

## Prerequisites

A working [wp-cli](http://wp-cli.org/#installing) install.

## Setup
Testing in the context of a WordPress plugin requires some additional setup.

If you are unfamiliar about the concerns using PHPunit and WordPress together, I highly recommend reading [this](https://carlalexander.ca/introduction-wordpress-unit-testing/), and [that](https://neliosoftware.com/blog/introduction-to-unit-testing-in-wordpress-phpunit/).

**Create the testing instance**

```sh
$: cd ~/wp-form-validation/
$: bash bin/install-wp-tests.sh wordpress_test root password localhost latest
```

If your database is inside a VM, open up a tunnel:
```sh
# e.g. from local:

$: ssh -N -L 5555:127.0.0.1:3306 vagrant@192.168.33.10 -vv
```

```sh
# Then, in a new local terminal:

$: cd ~/wp-form-validation/
$: bash bin/install-wp-tests.sh wordpress_test root root 127.0.0.1:5555 latest true
```

[Developing Locally on WordPress with Remote Database Over SSH](https://technosailor.com/2013/03/15/tutorial-developing-locally-on-wordpress-with-remote-database-over-ssh/)


## Run Tests

### Bash Script
*(recommended method once scripts mature)*

Set the plugin root path in:
`./tests/bin/config.local`

```sh
# Run the test suite

$: cd tests/bin
$: ./run.sh
```

### Directly
```sh
# Individual

$: vendor/bin/phpunit tests/InputTest --report-useless-tests --verbose
```

```sh
# Full suite

$: vendor/bin/phpunit --report-useless-tests --verbose
```

## External Resources

* [The command line interface for WordPress](http://wp-cli.org/)
* [Introduction To Wordpress Unit Testing](https://carlalexander.ca/introduction-wordpress-unit-testing/)
* [Unit Testing in WordPress – PHPUnit](https://neliosoftware.com/blog/introduction-to-unit-testing-in-wordpress-phpunit/)
