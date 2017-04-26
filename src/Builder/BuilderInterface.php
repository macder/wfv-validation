<?php
namespace WFV\Builder;
defined( 'ABSPATH' ) or die();

interface BuilderInterface {
  public function create();
  public function add_rules();
  public function add_input();
}
