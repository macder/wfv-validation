# WFV Validation
[![Build Status](https://travis-ci.org/macder/wfv-validation.svg?branch=master)](https://travis-ci.org/macder/wfv-validation)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/macder/wfv-validation/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/macder/wfv-validation/?branch=master)

WFV is an elegant way to work with custom forms in WordPress.

A simple fluid and concise API to manage user input, validation, feedback, and safe output.

**User documentation available at [https://macder.github.io/wfv/](https://macder.github.io/wfv/)**

WFV is intended for developers who prefer creating and managing forms at the code level. This is not a WYSIWYG type plugin and is not targeted for users who are not comfortable writing code.

# Table of Contents
* [Install](#install)
* [Testing]()
  * [Prerequisites](#prerequisites)
  * [Setup]()
* [Support](#support)
* [External Resources](#external-resources)

---

## Install

Note: WFV is in alpha testing and an official packaged release is not yet available. Once alpha testing is complete, WFV will be submitted for review into the official WordPress repo.

In the meantime, you may install the pre-release by either downloading the zip, or with git. Note that [Composer](https://getcomposer.org/) is required for both methods

The client API has standardized and there will be no more breaking changes as WFV moves towards the v1.0.0 milestone.

### Zip
Download the latest [pre-release zip](https://github.com/macder/wfv-validation/archive/master.zip)

### Git

```sh
$ cd ./wp-content/plugins

$ git clone https://github.com/macder/wfv-validation.git

$ cd wfv-validation

$ composer install
```

Activate the plugin in the admin dashboard

---



## Testing

### Prerequisites

A working [wp-cli](http://wp-cli.org) install.

Install PHPunit dependency by running `bin/lib/install_phpunit.sh`.

This will `composer require` the correct package for your local PHP version. The install is isolated to the project.


### Interactive Setup
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
  2. Collectable
  3. Inspection Agent
  4. Director
  5. Form Artisan
  6. Error Collection
  7. Input Collection
  8. Message Collection
  9. Rule Collection
  10. Form Composite

  11. Exit

Enter choice [ 1 - 11 ]

```

**Skip Main Menu**
```sh
#!/bin/bash

# Open testing menu
$: ./start_tests test

```

### Manual Setup
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

$: cd ~/wfv-validation/
$: bash bin/lib/install_wp_tests.sh wordpress_test db_user db_pass 127.0.0.1:5555 latest true
```

[Developing Locally on WordPress with Remote Database Over SSH](https://technosailor.com/2013/03/15/tutorial-developing-locally-on-wordpress-with-remote-database-over-ssh/)


**Run Tests**
```sh
#!/bin/bash

# Individual

$: vendor/bin/phpunit tests/Collection/InputCollectionTest --report-useless-tests --verbose
```

```sh
#!/bin/bash

# Full suite

$: vendor/bin/phpunit --report-useless-tests --verbose
```

## Support:
**PHP:** 5.4+<br>
**WordPress:** 4.x.x including multisite

**Unsupported Minimum:**<br>
**PHP:** 5.4+<br>
**WordPress:** 3.7 including multisite

PHP 7.0+ with latest WordPress is recommended.


## External Resources

* [The command line interface for WordPress](http://wp-cli.org/)
* [Introduction To Wordpress Unit Testing](https://carlalexander.ca/introduction-wordpress-unit-testing/)
* [Unit Testing in WordPress – PHPUnit](https://neliosoftware.com/blog/introduction-to-unit-testing-in-wordpress-phpunit/)
