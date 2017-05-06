#!/bin/bash

TEST_NAME=$1
TEST_PATH="tests/src/"$TEST_NAME

if [ "" == "$TEST_NAME" ] ; then
  TEST_NAME="All"
  TEST_PATH=""
fi

echo "Ok, Running $TEST_NAME"
echo ""
echo "vendor/bin/phpunit $TEST_PATH --report-useless-tests --verbose"
echo ""

cd ..
vendor/bin/phpunit $TEST_PATH --report-useless-tests --verbose
