# WFV - WordPress Form Validation

#### User Input API - *Simple. Concise. Safe*.

[Development & Testing](https://github.com/macder/wp-form-validation/tree/master/tests)

[![Build Status](https://travis-ci.org/macder/wp-form-validation.svg?branch=master)](https://travis-ci.org/macder/wp-form-validation)

Elegant form validation for WordPress.

```php
<?php // 32 built-in and custom rules

$form = [
  'rules' => [
    'email' => ['required', 'email']
  ]
];
```

**Safe:**<br>
`$form->input()->render('email');`

**Adaptable:**<br>
`$form->input()->render('email', 'strip_tags')`

**Flexible:**<br>
`$form->input()->render('email', function( $input ) {
  return strip_tags( $input );
});`

**Aware:**<br>
`$form->input()->contains( 'email', 'foo@bar.com' );`

**Helpful:**<br>
`$form->errors->first('email');`

**Pragmatic:**<br>
`$form->selected_if('color', 'green');`

**Simple:**<br>
`$form->input()->has('email');`

**Powerful:**<br>
`$form->constrain()->validate();`


# Table of Contents
* [Features](#features)
* [Basic Example](#basic-example)
* [Install](#install)
* [Usage](#usage)
  * [Rules](#rules)
  * [Custom Rules](#custom-rules)
  * [Custom Feedback](#custom-feedback)
  * [Validation Hooks](#validation-hooks)
  * [Markup a Form](#create-a-form-somewhere-in-your-theme)
  * [Form Composite](#form-composite)
  * [User Input](#user-input)
  * [Auto Populate](#auto-populate)
  * [Errors](#validation-errors)

## Features
* 32 built-in [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules) rules
* Custom rules
* Custom error messages
* [Helper methods](#user-input) for safe output
* Auto populate
* Multiple forms
* Validation Hooks
* Self POST - no redirects, no GET vars, no sessions, no cookies
* Lightweight - Only one dependency (WordPress aside)
* [Unit tested core](https://github.com/macder/wp-form-validation/tree/master/tests) - More stable, quicker fixes, less bugs, more happy
* No rendered markup
* Developer freedom

## Basic example

`functions.php` or wherever:
```php
<?php

// declare the rules
$my_form = array(
  'rules'   => array(
    'first_name' => ['required'],
    'email'      => ['required', 'email']
  )
);

// validation pass
add_action( 'contact_form', 'my_form_valid' );
function my_form_valid( $form ) {
  // do something...
}

// validation fail
add_action( 'contact_form_fail', 'my_form_invalid' );
function my_form_invalid( $form ) {
  // do something...
}

// create the instance
wfv_create( 'contact_form', $my_form );

// $my_form is now an instance of WFV\Composite\Form:

```

Theme template:
```php
<form method="post">
  <input name="email" type="text">
  <?php $my_form->get_token_fields(); ?>
  <input type="submit" value="Send">
</form>
```

# Install

**Minimum Requirements:**
* WordPress 3.7
* PHP 5.4

*PHP 7.0 support for WordPress 4.0+*

**Recommended:**
* WordPress 4.7.x
* PHP 7.0

**Pre-release**

`$ git clone` or download `master` to `./wp-content/plugins`

`$ composer install`


# Usage

## Rules

```php
<?php
$my_form = array(
  'rules'   => array(
    'first_name' => ['required'],
    'email'      => ['required', 'email'],
  )
);
```

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules) doc.

## Custom Rules

Prepend `custom:` to rule, name of rule is the callback.
```php
<?php
$my_form = array(
  'rules'   => array(
    'phone'      => ['required', 'custom:phone'],
  )
);
```
Create the callback:
```php
<?php // phone field will validate only if the input is 'hi' ...how cruel

function wfv__phone( $value ) {
  return ( 'hi' === $value ) ? true : false;
}
```

## Custom Feedback

```php
<?php
$my_form = array(
  'rules'   => array(
    'email'     => ['required', 'email']
  ),

  // override an error message
  'messages' => [
    'email' => array(
      'required' => 'No email, no reply... get it?'
    )
  ]
);
```

## Validation Hooks

**Pass:**

```php
<?php // action hook and callback for validation pass

add_action( 'contact_form', 'contact_form_valid' );
function contact_form_valid( $form ) {
  // form input valid, do something...
}
```

**Fail:**
```php
<?php // action hook and callback for validation fail

add_action( 'contact_form_fail', 'contact_form_invalid' );
function contact_form_invalid( $form ) {
  // form input NOT valid, do something...
}
```

## Markup a Form

```html
<form name="contact_form" method="post">
  <input name="name" type="text">
  <input name="email" type="text">
  <textarea name="msg"></textarea>

  <?php $my_form->get_token_fields(); ?>
  <input type="submit" value="Submit">
</form>
```
The form must have the required token tag:
```php
<?php $my_form->get_token_fields(); ?>
```
This adds 2 hidden fields, nonce and action. The generated action field identifies the form to a validation instance.

## Form Entity
### `wfv_create( string $action, array $form )`

Pass by reference an instance of `WFV\FormComposite`.

Example:
```php
<?php
// $my_form becomes an instance of WFV\FormComposite
wfv_create( 'contact_form', $my_form );
```


## User Input
### `WFV\Collection\InputCollection`
Immutable Collection

Available methods:
* [contains()](#input-contains)
* [has()](#has-input)
* [is_not_empty()](#is-not-empty)
* [render()](#render)
* [transform()](#transform)


* [checked_if()](#)
* [selected_if()](#)



```php
<?php

$input = $my_form->input();
```

### Contains
#### `contains( string $key, string $value )`
Check if `$key` contains `$value`, return `bool`

```php
<?php // Did the user enter foo@bar.com into the email field?

$my_form->input()->contains( 'email', 'foo@bar.com');  // true
```
```php
<?php // Did the user enter bar@foo.com into the email field?

$my_form->input()->contains( 'email', 'bar@foo.com');  // false
```


### Render
#### `render( string $key, callable $callback = null )`
Passes an input value through a callback and returns the new string.

Use this method to output encoded input values, eg. in markup templates

Default callback is `htmlspecialchars`:
```php
<?php // eg. user entered <h1>John</h1>

echo $my_form->input()->render('name');  // &lt;h1&gt;John&lt;/h1&gt;
```

Using a native PHP callback:
```php
<?php // eg. user entered <h1>John</h1>

echo $my_form->input()->render('name', 'strip_tags');  // John

// You can call any function that returns a string
// For multiple parameter callbacks, see 'Advanced usage'
```
#### Advanced usage

Custom callback:
```php
<?php // over-engineered string concatenation

// user entered foo@bar.com
echo $my_form->input()->render('email', 'append_to_string'); // foo@bar.com_lorem

function append_to_string( $string ) {
  return $string .'_lorem';
}
```

Closure:
```php
<?php

echo $my_form->input()->render('email', function( $string ){
  return $string .'_lorem';
});

// foo@bar.com_lorem
```

Callback with multiple parameters:
```php
<?php // even more over-engineered string concatenation

$callback = array( 'wfv_example', array( 'second', 'third' ) );

echo $my_form->input()->render( 'email', $callback ); // second-foo@bar.com-third

function wfv_example( $value, $arg2, $arg3 ) {
  return $arg2 .'-'. $value .'-'. $arg3;
}
```

### Has input
#### `has( string $field )`
Check if `$field` has value, return `bool`

```php
<?php // was something entered into the email field?

$my_form->input()->has('email');  // true
```



### Transform
#### `transform( string|array $input, string|array $callback )`
Transform a string or array leafs using a callback.

This method is similar to `render()`, except it can take in any string value (not just submitted input) or an array of strings.

If an array is passed in as the `$input` parameter, this method will traverse and apply the callback to each leaf.

Transform will traverse infinitively through an array's dimensions applying the callback to every leaf regardless of how deep the levels go.

The catch is it only transforms the leafs and DOES NOT touch the keys.

```php
<?php

$colors = array('red', 'blue', 'green');
$colors = $my_form->input()->transform( $colors, 'strtoupper' );

print_r( $colors );
/*
Array
(
    [0] => RED
    [1] => BLUE
    [2] => GREEN
)
*/
```
Multi-dimensional array:
```php
<?php

$options = array(
  'colors' => array(
    'red',
    'blue',
    'green',
    'premium' => array(
      'gold',
      'silver',
    )
  ),
  'shades' => array(
    'dark',
    'medium',
    'light',
  ),
);

$options = $my_form->input()->transform( $options, 'strtoupper' );

print_r( $options );
/*
Array
(
  [colors] => Array
    (
      [0] => RED
      [1] => BLUE
      [2] => GREEN
      [premium] => Array
        (
          [0] => GOLD
          [1] => SILVER
        )
    )

  [shades] => Array
    (
      [0] => DARK
      [1] => MEDIUM
      [2] => LIGHT
    )
)
*/
```
#### Advanced usage
Custom callback:
```php
<?php

$colors = array('red', 'blue', 'green');
$colors = $my_form->input()->transform( $colors, 'everything_green' );

function everything_green( $value ) {
  return 'GREEN';
}

print_r( $colors );
/*
Array
(
  [0] => GREEN
  [1] => GREEN
  [2] => GREEN
)
*/
```

Callback with multiple parameters:
```php
<?php // lets change red to green

$colors = array('red', 'blue', 'green');
$callback = array( 'change_color', array( 'red', 'green' ) );

$colors = $my_form->input()->transform( $colors, $callback );

function change_color( $value, $original, $new ) {
  return ( $value === $original ) ? $new : $value;
}

print_r( $colors );

/*
Array
(
  [0] => green
  [1] => blue
  [2] => green
)
*/
```

Closure:
```php
<?php // same thing as above, except using a closure

$colors = array('red', 'blue', 'green');

$original = 'red';
$new = 'green';

$colors = $my_form->input()->transform( $colors, function( $value ) use ( $original, $new ) {
  return ( $value === $original ) ? $new : $value;
});
```

## Auto Populate

### Text input

If validation fails, these fields would populate using the submitted values:
```html
<input name="email" type="text" value="<?= $my_form->input->render('email') ?>">
```

```html
<textarea name="msg"><?= $my_form->input()->render('msg') ?></textarea>
```

### Checkboxes and Radio
#### `checked_if( string $field, string $value )`
Return string `'checked'` when `$field` has input `$value`.

```php
<?php // will echo 'checked' if user checked 'green' checkbox

echo $my_form->checked_if('color', 'green'); // checked

```

Checkbox:
```php
<input name="color[]" type="checkbox" value="green" <?= $my_form->checked_if('color', 'green'); ?>>
<input name="color[]" type="checkbox" value="blue" <?= $my_form->checked_if('color', 'blue'); ?>>
<input name="color[]" type="checkbox" value="red" <?= $my_form->checked_if('color', 'red'); ?>>
```

Radio:
```php
<input name="agree" type="radio" value="yes" <?= $my_form->checked_if('agree', 'yes'); ?>>
<input name="agree" type="radio" value="no" <?= $my_form->checked_if('agree', 'no'); ?>>
```

### Select and multi-select
#### `selected_if( string $field, string $value )`
Return string `'selected'` when `$field` has input `$value`.

```php
<?php // will echo 'selected' if user selected 'green' in select input

echo $my_form->selected_if('color', 'green'); // selected
```

Select:
```php
<select name="title">
  <option value="">Select...</option>
  <option value="Mr" <?= $my_form->selected_if('title', 'Mr'); ?>>Mr</option>
  <option value="Dr" <?= $my_form->selected_if('title', 'Dr'); ?>>Dr</option>
  <option value="Miss" <?= $my_form->selected_if('title', 'Miss'); ?>>Miss</option>
  <option value="Mrs" <?= $my_form->selected_if('title', 'Mrs'); ?>>Mrs</option>
</select>
```

Multi-select:
```php
<select name="color[]" multiple>
  <option value="red"<?= $my_form->selected_if('color', 'red'); ?>>Red</option>
  <option value="blue"<?= $my_form->selected_if('color', 'blue'); ?>>Blue</option>
  <option value="green"<?= $my_form->selected_if('color', 'green'); ?>>Green</option>
</select>
```

## Validation Errors
### `WFV\Collection\ErrorCollection`

```php
<?php // $errors becomes instance of WFV\Collection\ErrorCollection

$errors = $my_form->errors();
```
### Has error
#### `has( string $field )`
Check if `$field` has error, return `bool`
```php
<?php // does the email field have an error?

$my_form->errors()->has('email'); // true or false
```

### Get field errors:
```php
<?php // get the error bag for a field

// $email_errors = $my_form->errors()->email;

foreach( $email_errors as $error ) {
  echo $error;
}
```

### Get field's first error
#### `first( string $field )`
Convienience method to get first error on field.

```php
<?php // get the first email error message

echo $my_form->errors()->first('email'); // Email is required
```
First error message is the first declared rule.

For example: `required` is the first error if rules are declared as `['required', 'email']` and both validations fail.


## Development

`$ git clone` inside `./wp-content/plugins`

`$ composer install`

Checkout the `develop` branch

`$ git checkout develop`

Create new feature branch

`$ git checkout -b feature/[name]`

`$ git push origin feature/[name]`

When your feature is ready and tested

`$ git fetch origin develop`

`$ git merge origin/develop`

`$ git push origin feature/[name]`

Now test to ensure your code works on `develop`

Create a pull request to merge your feature branch into `develop`
