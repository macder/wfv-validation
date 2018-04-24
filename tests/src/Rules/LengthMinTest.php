<?php
namespace WFV\Rules;

use \Respect\Validation\Validator as RespectValidator;

class LengthMinTest extends \PHPUnit_Framework_TestCase {

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
    self::$validator = new LengthMin( new RespectValidator() );
  }

  /**
   * Reset
   *
   */
  protected function tearDown() {
    self::$validator = null;
  }

  /**
   * Does length_min validation return true when
   *  validation is NOT optional
   *  and input length greater than min?
   *
   */
  public function test_length_min_returns_true_when_not_optional_and_input_greater() {
    $optional = false;
    $params = [2];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertTrue( $result );
  }

  /**
   * Does length_min validation return true when
   *  validation is optional
   *  and input length greater than min?
   *
   */
  public function test_length_min_returns_true_when_optional_and_input_greater() {
    $optional = true;
    $params = [2];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertTrue( $result );
  }


  /**
   * Does length_min validation return false when
   *  validation is NOT optional
   *  and input length less than min?
   *
   */
  public function test_length_min_returns_false_when_not_optional_and_input_less() {
    $optional = false;
    $params = [10];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertFalse( $result );
  }

  /**
   * Does length_min validation return false when
   *  validation is optional
   *  and input length less than min?
   *
   */
  public function test_length_min_returns_false_when_optional_and_input_less() {
    $optional = true;
    $params = [10];

    $result = self::$validator->validate( 'abcdef', $optional, $params );
    $this->assertFalse( $result );
  }
}
