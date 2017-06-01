<?php
namespace WFV\Rules;

use \Respect\Validation\Validator;

class LengthMaxTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   *
   * @access protected
   * @var ValidateInterface
   */
  protected static $validator;

  /**
   *
   *
   */
  protected function setUp() {
    self::$validator = new LengthMax();
  }

  /**
   * Reset
   *
   */
  protected function tearDown() {
    self::$validator = null;
  }

  /**
   * Does length_max validation return true when
   *  validation is NOT optional
   *  and input length shorter than max?
   *
   */
  public function test_length_max_returns_true_when_not_optional_and_input_shorter() {
    $optional = false;
    $params = [10];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertTrue( $result );
  }

  /**
   * Does length_max validation return true when
   *  validation is optional
   *  and input length shorter than max?
   *
   */
  public function test_length_max_returns_true_when_optional_and_input_shorter() {
    $optional = true;
    $params = [10];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertTrue( $result );
  }


  /**
   * Does length_max validation return false when
   *  validation is NOT optional
   *  and input length greater than max?
   *
   */
  public function test_length_max_returns_false_when_not_optional_and_input_greater() {
    $optional = false;
    $params = [2];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertFalse( $result );
  }

  /**
   * Does length_max validation return false when
   *  validation is optional
   *  and input length greater than max?
   *
   */
  public function test_length_max_returns_false_when_optional_and_input_greater() {
    $optional = true;
    $params = [2];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertFalse( $result );
  }
}
