<?php

namespace WFV;

use WFV\Rules;

class RulesTest extends \PHPUnit_Framework_TestCase {

  const FORM = array(
    'action' => 'phpunit',

    'rules'  => array(
      'first_name' => ['required', 'alpha'],
      'last_name' => ['required', 'alpha'],
      'phone'      => ['required', 'custom:phone'],
      'username'   => ['required'],
      'password'   => ['required'],
      'email'      => ['email','required'],
      'website'    => ['required', 'url'],
      'postal'     => ['custom:postal_code'],
    )
  );
}
