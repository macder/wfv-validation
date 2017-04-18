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


function set_params_from_input {
  for i in "${!WP_PROPERTY[@]}" ; do
    user_param_input "${WP_PROPERTY[$i]}" "${WP_DEFAULT[$i]}"
    WP_SETTINGS[$i]=$input
  done
}

function ssh_tunnel {
  user_confirm "e.g Docker, Vagrant, VM" "Is the database remote?"

  if $confirm ; then
    user_confirm "e.g vagrant@192.168.33.10" "Open SSH Tunnel to remote DB?"
    if $confirm ; then
      user_confirm "ssh -N -L 5555:127.0.0.1:3306 vagrant@192.168.33.10 -vv" "Use default SSH settings?"
    fi
  fi
}
