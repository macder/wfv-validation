# Unit Testing

Testing in the context of a WordPress plugin requires some additional setup.

The concern is to have a local WordPress testing instance so PHPunit has access to the API. Otherwise, any calls to WP methods would fail.

[Helpful links](#external-resources)


## Prerequisites

Make sure you have [wp-cli](http://wp-cli.org/#installing) installed.

## Setup

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
$: ./test.sh
```

### Directly
```sh
# Individual

$: vendor/bin/phpunit test/Input --report-useless-tests --verbose
```

```sh
# Full suite

$: vendor/bin/phpunit --report-useless-tests --verbose
```

## External Resources

* [The command line interface for WordPress](http://wp-cli.org/)
* [Introduction To Wordpress Unit Testing](https://carlalexander.ca/introduction-wordpress-unit-testing/)
* [Unit Testing in WordPress – PHPUnit](https://neliosoftware.com/blog/introduction-to-unit-testing-in-wordpress-phpunit/)
