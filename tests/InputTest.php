<?php

namespace WFV;

use WFV\Input;

class InputTest extends \PHPUnit_Framework_TestCase {

  /**
   *
   *
   * @access protected
   * @var
   */
  protected static $expected_result;

  /**
   * Mock $_POST
   *
   * @access protected
   * @var
   */
  protected static $http_post;

  /**
   *
   *
   * @access protected
   * @var class WFV\Input
   */
  protected static $input_after_post;

  /**
   *
   *
   * @access protected
   * @var class WFV\Input
   */
  protected static $input_before_post;

  /**
   *
   *
   */
  public static function setUpBeforeClass() {

  }

  /**
   *
   *
   */
  protected function setUp() {
    self::$http_post = array(
      'action' => 'phpunit',
      'name' => '<h1>Foo Bar</h1>',
      'email' => 'foo@bar.com',
      '<% skills %>' =>
        array(
          'js <script>console.log("oh no!");</script>',
          'php <?php echo "oh no!"; ?>',
        )
      );

    self::$expected_result = array(
      'action' => 'phpunit',
      'name' => 'Foo Bar', // &lt;h1&gt;Foo Bar&lt;/h1&gt;
      'email' => 'foo@bar.com',
      'skills' =>
        array(
          'js',
          'php',
        )
    );
    self::$input_before_post = new Input('phpunit');

    $_POST = self::$http_post;
    self::$input_after_post = new Input('phpunit');
  }

  public function tearDown() {
    $_POST = null;
  }

  /**
   * Reset $_POST
   *
   */
  public static function tearDownAfterClass() {
    $_POST = null;
  }

  /**
   * Is input an instance of WFV\Input?
   *
   */
  public function test_input_is_instance() {
    $this->assertInstanceOf( 'WFV\Input', self::$input_before_post );
    $this->assertInstanceOf( 'WFV\Input', self::$input_after_post );
  }

  /**
   *
   *
   */
  public function test_input_render_returns_default_escaped_string_from_property() {
    $input = self::$input_after_post;

    $expected_result = htmlspecialchars( $input->name );
    $result = $input->render('name');

    $this->assertEquals( $expected_result, $result );
  }

  /**
   *
   *
   */
  public function test_input_render_returns_default_escaped_string_when_no_property() {
    $input = self::$input_after_post;

    $expected_result = htmlspecialchars( '<p>phpunit<p>' );
    $result = $input->render('<p>phpunit<p>');

    $this->assertEquals( $expected_result, $result );
  }

  /**
   *
   *
   */
  public function test_input_render_returns_null() {
    $input = self::$input_after_post;

    $expected_result = null;
    $result = $input->render( array('php', 'unit') );

    $this->assertEquals( $expected_result, $result );
  }

  /**
   *
   *
   */
  public function test_input_render_supported_single_param_callbacks() {
    $callback = array(
      'addslashes',
      'bin2hex',
      'htmlentities',
      'html_entity_decode',
      'htmlspecialchars',
      'htmlspecialchars_decode',
      'lcfirst',
      'ltrim', // only 1st param
      'md5',
      'nl2br',
      'quotemeta',
      'rtrim',
      'stripslashes',
      'ucfirst',
      'ucwords',

    );

    $strings = array(
      '<p>phpunit</p>',
      '&lt;p&gt;phpunit&lt;/p&gt;',
      'php\\\'unit\\\'',
      'php\'unit\'',
      'Phpunit',
      'PHPUNIT',
      'pHpUnIt',
      'PhPuNiT',
      ' phpunit',
      'phpunit ',
      ' phpunit ',
      'test test
        test',
      '. \ + * ? [ ^ ] ( $ )',
      'lorem ipsum dolor sit amet',
    );

    $input = self::$input_after_post;
    foreach( $strings as $value ) {
      foreach( $callback as $method ) {
        $expected_result = $method( $value );
        $result = $input->render( $value, $method );
        $this->assertEquals( $expected_result, $result );
      }
    }
  }
}
