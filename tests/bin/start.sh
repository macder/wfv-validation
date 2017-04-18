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

yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }

function user_confirm {
  echo -e "\n"$2"\n"$1"\n"
  select result in Yes No
  do
    confirm=$([ $REPLY == 1 ] && echo true || echo false )
    if [ $REPLY == 1 ] || [ $REPLY == 2 ] ; then
      break
    fi
  done
}

# 1-parameter 2-default
function user_param_input {
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
