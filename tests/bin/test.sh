#!/bin/bash

# Run test suite
#
#

mapfile -t CONFIG < config

root_path=${CONFIG[1]} # line 2 in ./config

cd $root_path
vendor/bin/phpunit tests/FormTest --report-useless-tests --verbose
