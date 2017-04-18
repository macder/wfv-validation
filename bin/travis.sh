#!/bin/bash

yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }


php_version=$(php --version | head -n 1 | cut -d " " -f 2 | cut -c 1,3);

if [ 70 = "$php_version" ]; then
  composer global require "phpunit/phpunit=5.7.*"
else
  composer global require "phpunit/phpunit=4.8.*"
fi

composer require "vlucas/valitron=^1.4"

# ${TRAVIS_PHP_VERSION:0:2}
