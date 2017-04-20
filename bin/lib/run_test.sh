#!/bin/bash

TEST_NAME="tests/"$1

# Run test suite
#
#
yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }

mapfile -t CONFIG < config.local

# git update-index --assume-unchanged config.local

root_path=${CONFIG[1]} # line 2 in ./config

# check if path was set in config.local
if [ ! -d "$root_path" ]; then
  die "The PATH defined in config.local does not exist!"
fi

cd $root_path
vendor/bin/phpunit $TEST_NAME --report-useless-tests --verbose
