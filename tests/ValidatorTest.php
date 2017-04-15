<?php

namespace WFV;

use WFV\Factory\ValidationFactory;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

  const FORM = array(
    'action'  => 'contact_form', // unique identifier
    'rules'   => array(
      'title'     => ['required'],
      'name'      => ['required'],
      //'phone'     => ['required', 'custom:phone'],
      'email'     => ['required', 'email'],
      //'postal'    => ['custom:postal_code'],
      'website'   => ['required', 'url'],
      // 'msg'       => ['required']
    ),

    // override an error msg
    'messages' => [
      'email' => array(
        'required' => 'Your email is required so we can reply back'
      )
    ]
  );

  /**
   *
   *
   */
  public function test_validator_factory_create() {
    $form = self::FORM;
    ValidationFactory::create( $form );

    $this->assertInstanceOf( 'WFV\Validator', $form );
    $this->assertInstanceOf( 'WFV\Errors', $form->errors );
    $this->assertInstanceOf( 'WFV\Input', $form->input );
    $this->assertInstanceOf( 'WFV\Messages', $form->messages );
    $this->assertInstanceOf( 'WFV\Rules', $form->rules );
  }
}
