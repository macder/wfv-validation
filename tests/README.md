# WFV Unit Testing
[![Build Status](https://travis-ci.org/macder/wp-form-validation.svg?branch=master)](https://travis-ci.org/macder/wp-form-validation)


# Table of Contents
* [Architecture](#architecture)
* [Prerequisites](#prerequisites)
* Setup
  * [Interactive](#interactive-setup)
  * [Manual](#manual-setup)
* [Support](#support)
* [External Resources](#external-resources)

## Architecture

**Creation**<br>
Builder

**Structure**<br>
Composite

**Behavioural**<br>
Adapter

## Prerequisites

A working [wp-cli](http://wp-cli.org) install.

Install PHPunit dependency by running `bin/lib/install_phpunit.sh`.

This will `composer require` the correct package for your local PHP version. The install is isolated to the project.


## Interactive Setup
The easiest way to get setup and test is using the interactive bash script `bin/start_tests`

It's menu driven, with the hope of making more of the process self explanatory.

**1) Set Local Parameters**

Rename `bin/tests_sample.conf` to `bin/tests.conf`, then open with an editor.

Set your local parameters, you know the drill.

**2) Start**

```sh
#!/bin/bash

# From plugin root:
$: cd bin
$: ./start_tests

```
```sh
--------------------------------
 W F V   U N I T  T E S T I N G
--------------------------------
 MAIN MENU
--------------------------------

  1. SSH Tunnel For Remote DB
  2. Start WordPress Testing Instance
  3. Run Tests

  4. Exit

Enter choice [ 1 - 4 ]

```

**1. SSH Tunnel:**<br>
Starts SSH tunnel to a remote DB host. If your DB is local, you don't need this.

**2. Start wp-tests Instance**<br>
Creates and starts the wp-tests instance.

**3.Run Tests**
```sh
--------------------------------
 W F V   U N I T  T E S T I N G
--------------------------------
 UNIT TESTS
--------------------------------

  0. Back

  1. ALL
  2. Accessor
  3. Input
  4. Form
  5. Mutator
  6. Guard

  7. Exit

Enter choice [ 1 - 7 ]

```

**Skip Main Menu**
```sh
#!/bin/bash

# Open testing menu
$: ./start_tests test

```

## Manual Setup
The nuts and bolts of what `./start_tests` is doing

**Create the testing instance**

If database is local:
```sh
#!/bin/bash

# From plugin root
$: bash bin/lib/install_wp_tests.sh wordpress_test db_user db_pass localhost latest
```

If database is remote (Docker, Vagrant, VM) open a SSH tunnel:
```sh
#!/bin/bash

# e.g. from local:

$: ssh -N -L 5555:127.0.0.1:3306 vagrant@192.168.33.10 -vv
```

```sh
#!/bin/bash

# Then, in a new local terminal:

$: cd ~/wp-form-validation/
$: bash bin/lib/install_wp_tests.sh wordpress_test db_user db_pass 127.0.0.1:5555 latest true
```

[Developing Locally on WordPress with Remote Database Over SSH](https://technosailor.com/2013/03/15/tutorial-developing-locally-on-wordpress-with-remote-database-over-ssh/)


**Run Tests**
```sh
#!/bin/bash

# Individual

$: vendor/bin/phpunit tests/InputTest --report-useless-tests --verbose
```

```sh
#!/bin/bash

# Full suite

$: vendor/bin/phpunit --report-useless-tests --verbose
```

## Support:
**PHP:** 5.4+<br>
**WordPress:** 4.x.x including multisite

[0.9.1](https://github.com/macder/wp-form-validation/tree/0.9.1) is passing on: [WordPress 4.7.4 + multisite / PHP 5.4, 5.5, 5.6, 7.0](https://travis-ci.org/macder/wp-form-validation/builds/225493740)

**Minimum un-supported version:**<br>
[0.9.1](https://github.com/macder/wp-form-validation/tree/0.9.1) is passing on: [WordPress 3.7 + multisite / PHP 5.4, 5.5, 5.6](https://travis-ci.org/macder/wp-form-validation/builds/225493342)

## External Resources

* [The command line interface for WordPress](http://wp-cli.org/)
* [Introduction To Wordpress Unit Testing](https://carlalexander.ca/introduction-wordpress-unit-testing/)
* [Unit Testing in WordPress – PHPUnit](https://neliosoftware.com/blog/introduction-to-unit-testing-in-wordpress-phpunit/)
