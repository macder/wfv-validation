#!/bin/bash

yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }

echo "Travis PHP: travis.sh w0w0w"

# ${TRAVIS_PHP_VERSION:0:2}
