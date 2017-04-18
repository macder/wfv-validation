#!/bin/bash

#
# WIP - Do not use
#

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

declare SSH_PROPERTY=(
  "SSH_PORT_IN"
  "SSH_LOCAL_IP"
  "SSH_PORT_OUT"
  "SSH_REMOTE_USER"
  "SSH_REMOTE_HOST"
)

declare SSH_DEFAULT=(
  "5555"
  "127.0.0.1"
  "3306"
  "vagrant"
  "192.168.33.10"
)

# 5555:127.0.0.1:3306 vagrant@192.168.33.10

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

  db_is_remote=$confirm;

  if $db_is_remote ; then
    user_confirm "e.g vagrant@192.168.33.10" "Open SSH Tunnel to remote DB?"
  fi
  ssh_open_tunnel=$confirm;

  if $ssh_open_tunnel ; then
    user_confirm "ssh -N -L 5555:127.0.0.1:3306 vagrant@192.168.33.10 -vv" "Use default SSH settings?"
  fi
  ssh_use_default=$confirm;

  # if $confirm ; then
  #   user_confirm "e.g vagrant@192.168.33.10" "Open SSH Tunnel to remote DB?"
  #   if $confirm ; then
  #     user_confirm "ssh -N -L 5555:127.0.0.1:3306 vagrant@192.168.33.10 -vv" "Use default SSH settings?"
  #     if $confirm ; then
  #       echo "Default SSH"
  #     else
  #       echo "Custom SSH"
  #     fi
  #   fi
  # fi
}


ssh_tunnel
set_params_from_input

echo ${WP_SETTINGS[0]} ${WP_SETTINGS[1]} ${WP_SETTINGS[2]} ${WP_SETTINGS[3]} ${WP_SETTINGS[4]} ${WP_SETTINGS[5]}

# bash bin/install-wp-tests.sh wordpress_test root password localhost latest
