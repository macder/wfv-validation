#!/bin/bash

# Run test suite
#
#
yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }

mapfile -t CONFIG < config

root_path=${CONFIG[1]} # line 2 in ./config

cd $root_path
vendor/bin/phpunit --report-useless-tests --verbose
