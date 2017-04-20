#!/bin/bash

ITEMS=("$@")

show_menu() {
  local -n MENU_ITEMS="$1"

  clear
  echo "--------------------------------"
  echo " W F V   U N I T  T E S T I N G "
  echo "--------------------------------"
  echo " ${MENU_ITEMS[0]}"
  echo "--------------------------------"
  echo ""

  MENU_NAME=${MENU_ITEMS[0]}
  unset MENU_ITEMS[0]

  if [ "$MENU_NAME" != "MAIN MENU" ] ; then
    echo "  0. Back"
    echo ""
  fi

  for INDEX in "${!MENU_ITEMS[@]}" ; do
    echo "  $INDEX. ${MENU_ITEMS[INDEX]}"
  done

  echo "  $((INDEX+1)). Exit"
  echo ""
}

show_menu ITEMS
