#!/bin/bash

yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }

php --version | head -n 1 | cut -d " " -f 2 | cut -c 1,3

# ${TRAVIS_PHP_VERSION:0:2}
