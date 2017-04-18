#!/bin/bash

# ["Question"]="default"
declare -A DEFAULT=(
  ["Database_Name"]="wordpress_test"
)
# 1-question 2-default
function user_confirm {
  read -p "$1 (default: $2): " input
  input=${input:-$2}
}

# DB_NAME=$1
# DB_USER=$2
# DB_PASS=$3
# DB_HOST=${4-localhost}
# WP_VERSION=${5-latest}
# SKIP_DB_CREATE=${6-false}

for i in ${!DEFAULT[*]} ; do

  default=${DEFAULT[$i]}
  user_confirm "$i" "$default"
  DEFAULT[$i]=$input
  echo ${DEFAULT[$i][*]}
done
