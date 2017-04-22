# WFV - WordPress Form Validation

#### Declarative input validation API for WordPress

[![Build Status](https://travis-ci.org/macder/wp-form-validation.svg?branch=master)](https://travis-ci.org/macder/wp-form-validation)

Intended for developers who want to build forms in a theme using custom markup and validate the input in a declarative way.

WFV gives you the ability to declare form validation constraints in a similar way found in MVC frameworks such as [Laravel](https://laravel.com/).

Markup a form in a template and define its constraints in `functions.php`, a plugin, or wherever. Everything is up to you, the developer.

You get a simple declarative API that helps you work with forms and input in an elegant way.

WFV uses [Valitron](https://github.com/vlucas/valitron), a lightweight library without dependencies, to validate input constraints.

For testing, see [WFV Unit Testing](https://github.com/macder/wp-form-validation/tree/master/tests)


# Table of Contents
* [Features](#features)
* [Basic Example](#basic-example)
* [TODO](#todo)
* [Install](#install)
* [Usage](#usage)
  * [Rules](#configure-validation-rules)
  * [Custom Rules](#custom-validation-rules)
  * [Custom Error Messages](#custom-error-messages)
  * [Action Hooks](#validation-action-hooks)
  * [Markup a Form](#create-a-form-somewhere-in-your-theme)
  * [Validation Instance](#create-the-validation-instance)
  * [User Input](#user-input)
  * [Auto Populate](#auto-populate)
  * [Errors](#validation-errors)

## Features
* 32 built-in [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules) rules
* Custom rules
* Custom error messages
* No escape-on-input
* Powerful and customizable helper methods for rendering, escaping, filtering, and transforming
* Auto populate fields, including [checkboxes, radio](#checkboxes-and-radio) and [multi-selects](#select-and-multi-select)
* Action hooks for validation pass and fail
* Self POST - no redirects, no GET vars, no sessions, no cookies
* Declarative and object oriented API
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
  'action'  => 'contact_form',
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
wfv_create( $my_form );

// $my_form is now an instance of WFV\Validator:
$my_form             // WFV\Validator
$my_form->input;     // WFV\Input
$my_form->errors;    // WFV\Errors
$my_form->rules;     // WFV\Rules
$my_form->messages;  // WFV\Messages

```

Theme template:
```php
<form method="post">
  <input name="email" type="text">
  <?php $my_form->get_token_fields(); ?>
  <input type="submit" value="Send">
</form>
```


## TODO
- API endpoint for front end - support single configuration.

# Install

**Minumum Requirements:**
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

## Configure validation rules

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'first_name' => ['required'],
    'email'      => ['required', 'email'],
  )
);
```

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules) doc.

## Custom validation rules

Prepend `custom:` to rule, name of rule is the callback.
```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
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

## Custom error messages

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'email'     => ['required', 'email']
  ),

  // override an error msg
  'messages' => [
    'email' => array(
      'required' => 'No email, no reply... get it?'
    )
  ]
);
```

## Validation action hooks

When the input validates, i.e. passes all the constraints, the action hook defined in `$my_form['action']` is triggered. When it fails, the action hook appended with `_fail` triggers.

**Validation Pass:**

```php
<?php // action hook and callback for validation pass

add_action( 'contact_form', 'contact_form_valid' );
function contact_form_valid( $form ) {
  // form input valid, do something...
  echo $form->input->name;
  echo $form->input->email;
}
```

**Validation Fail:**
```php
<?php // action hook and callback for validation fail

add_action( 'contact_form_fail', 'contact_form_invalid' );
function contact_form_invalid( $form ) {
  // form input NOT valid, do something...
  echo $form->input->name;
  echo $form->input->email;
}
```

## Create a form somewhere in your theme

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

## Create the validation instance
### `wfv_create( array $form )`
Send `array $form` to the `WFV\Factory\ValidationFactory` to create an instance of `WFV\Validator`

The instance is assigned by reference:
```php
<?php
// $my_form becomes an instance of WFV\Validator
wfv_create( $my_form );
```

`$my_form` can now access properties and methods available to `WFV\Validator`

```php
<?php
$my_form->input;     // Instance of WFV\Input
$my_form->errors;    // Instance of WFV\Errors
$my_form->rules;     // Instance of WFV\Rules
$my_form->messages;  // Instance of WFV\Messages
```
**Get and Set:**

All property instances on `WFV\Validator` share the same accessor and mutator traits.

Examine [`AccessorTrait.php`](https://github.com/macder/wp-form-validation/blob/master/src/AccessorTrait.php) and [`MutatorTrait.php`](https://github.com/macder/wp-form-validation/blob/master/src/MutatorTrait.php) for available methods to get and set properties.

## User input
### `WFV\Input`
Instance holding form input data as properties, and input helper methods.

Available methods:
* [render()](#render)
* [transform()](#transform)
* [get_array()](#get-array)
* [has()](#has-input)
* [contains()](#input-contains)

*Plus methods from Mutator and Accessor traits*

The `input` property on `WFV\Validator` is an instance of `WFV\Input`

```php
<?php // $input becomes instance of WFV\Input

$input = $my_form->input;
```

After a form submission, the input data is populated as properties. The property names will be the forms field names

e.g:
```php
<?php
$my_form->input->name;  // Foo
$my_form->input->email; // foo@bar.com
```
### **Caution:**
Input properties hold raw `$_POST` values.<br>

For output to external systems make sure to encode the data to the appropriate context. If storing input to a database, make use of a WordPress API, eg. [wpdb](https://codex.wordpress.org/Class_Reference/wpdb).<br>

WFV adheres to ***filter but don't escape on input.***

The responsibility of form validation is filtering input as defined by a set of rules and constraints. Deciding how that data will be used and its path through the system is outside the scope of gatekeeping.

Encoding should happen at the time when some context requires it, e.g output to external systems - database, API endpoint, etc. What use is `mysqli_real_escape_string` it rendered in a markup template? Context dictates the encoding, validation filters.

Manipulating data without context is not useful and introduces more problems than it's trying to solve. Remember [Magic Quotes](http://php.net/manual/en/security.magicquotes.php)?

For more info on the subject, read ["Why escape-on-input is a bad idea"](https://lukeplant.me.uk/blog/posts/why-escape-on-input-is-a-bad-idea/)

**Note:** WFV strips magic quotes if they're enabled in the environment. You're welcome.

That being said, WFV does provide useful (perhaps powerful?) helpers to work with input data:

### Render
#### `render( string $field, string|array $callback = 'htmlspecialchars' )`
Passes an input value through a callback and returns the new string.

Use this method to output encoded input values, eg. in markup templates

Default callback is `htmlspecialchars`:
```php
<?php // eg. user entered <h1>John</h1>

echo $my_form->input->render('name');  // &lt;h1&gt;John&lt;/h1&gt;
```

Using a native PHP callback:
```php
<?php // single parameter callback

// user entered john into name field
echo $my_form->input->render('name', 'ucfirst');     // John
echo $my_form->input->render('name', 'strtoupper');  // JOHN

// You can use any PHP function that returns a string
```
#### Advanced usage

Custom callback:
```php
<?php // over-engineered string concatenation

// user entered foo@bar.com
echo $my_form->input->render('email', 'append_to_string'); // foo@bar.com_lorem

function append_to_string( $string ) {
  return $string .'_lorem';
}
```

Or with a closure:
```php
<?php

echo $my_form->input->render('email', function( $string ){
  return $string .'_lorem';
});

// foo@bar.com_lorem
```

Callback with multiple parameters:
```php
<?php // even more over-engineered string concatenation

$callback = array( 'wfv_example', array( 'second', 'third' ) );

echo $my_form->input->render( 'email', $callback ); // second-foo@bar.com-third

function wfv_example( $value, $arg2, $arg3 ) {
  return $arg2 .'-'. $value .'-'. $arg3;
}
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
$colors = $my_form->input->transform( $colors, 'strtoupper' );

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

$options = $my_form->input->transform( $options, 'strtoupper' );

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

### Get array
#### `get_array()`

Get input members as an array:
```php
<?php // get users input as an associative array

$input = $my_form->input->get_array();
echo $input['email']; // foo@bar.com
```

### Has input
#### `has( string $field )`
Check if `$field` has value, return `bool`

```php
<?php // was something entered into the email field?

$my_form->input->has('email');  // true
```

### Input contains
#### `contains( string $field, string $value )`
Check if `$field` contains `$value`, return `bool`

```php
<?php // Did the user enter foo@bar.com into the email field?

$my_form->input->contains( 'email', 'foo@bar.com');  // true
```
```php
<?php // Did the user enter bar@foo.com into the email field?

$my_form->input->contains( 'email', 'bar@foo.com');  // false
```

## Auto Populate

### Text input

If validation fails, these fields would populate using the submitted values:
```html
<input name="email" type="text" value="<?= $my_form->input->render('email') ?>">
```

```html
<textarea name="msg"><?= $my_form->input->render('msg') ?></textarea>
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

### Pre populate
#### `put( string $field, string $value )`
Pre-populate a field before `$_POST`

```php
<?php // the email field will always be pre populated with foo@bar.com

$my_form->input->put('email', 'foo@bar.com');
```
```html
<input name="email" type="text" value="<?= $my_form->input->render('email') ?>">
```

## Validation Errors
### `WFV\Errors`
Class instance that holds validation errors.

The `errors` property on `WFV\Validator` is an instance of `WFV\Errors`
```php
<?php // $errors becomes instance of WFV\Errors

$errors = $my_form->errors;
```
### Has error
#### `has( string $field )`
Check if `$field` has error, return `bool`
```php
<?php // does the email field have an error?

$my_form->errors->has('email'); // true or false
```

### Get field errors:
```php
<?php // get the error bag for a field

$email_errors = $my_form->errors->email;

foreach( $email_errors as $error ) {
  echo $error;
}
```

### Get field's first error
#### `error( string $field )`
Convienience method to get first error on field.

```php
<?php // get the first email error message

echo $my_form->error('email'); // Email is required
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
