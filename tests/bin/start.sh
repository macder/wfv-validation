#!/bin/bash

declare WP_PROPERTY=(
  "DB_NAME"
  "DB_USER"
  "DB_PASS"
  "DB_HOST"
  "WP_VERSION"
  "SKIP_DB_CREATE"
)

declare WP_DEFAULT=(
  "wordpress_test"
  "root"
  "root"
  "localhost"
  "latest"
  "false"
)

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
