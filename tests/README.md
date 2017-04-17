# Unit Testing

Testing in the context of a WordPress plugin requires some additional setup.

The concern is to have a local WordPress testing instance so PHPunit has access to the API. Otherwise, any calls to WP methods would fail.

## Prerequisites

Make sure you have [wp-cli](http://wp-cli.org/#installing) installed.

## Setup

**Create the testing instance**

```sh
$: cd ~/wp-form-validation/
$: bash bin/install-wp-tests.sh wordpress_test root password localhost latest
```

If your database is inside a VM, open up a tunnel.


```sh
# On your local machine, run:

$: ssh -N -L 5555:127.0.0.1:3306 vagrant@192.168.33.10 -vv
```
```sh
# Then, in a new terminal:

$: cd ~/wp-form-validation/
$: bash bin/install-wp-tests.sh wordpress_test root root 127.0.0.1:5555 latest true
```

## External Resources

* [The command line interface for WordPress](http://wp-cli.org/)
* [Introduction To Wordpress Unit Testing](https://carlalexander.ca/introduction-wordpress-unit-testing/)
* [Unit Testing in WordPress – PHPUnit](https://neliosoftware.com/blog/introduction-to-unit-testing-in-wordpress-phpunit/)
