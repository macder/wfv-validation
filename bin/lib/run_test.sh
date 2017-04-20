#!/bin/bash

TEST_NAME=$1
TEST_PATH="tests/"$TEST_NAME

if [ "" == "$TEST_NAME" ] ; then
  TEST_NAME="All"
fi

echo "Ok, Running $TEST_NAME"
echo ""

cd ..
vendor/bin/phpunit $TEST_PATH --report-useless-tests --verbose
