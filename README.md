# WFV
### WordPress Form Validation

** WORK IN PROGRESS **

Release date: Soon

# Table of Contents
1. [Basic Example](#basic-example)
2. [Introduction](#introduction)
3. [Features](#features)
4. [TODO](#todo)
5. [Install](#install)
6. [Usage](#usage)
    1. [Rules](#configure-validation-rules)
    2. [Custom Rules](#custom-validation-rules)
    3. [Error Messages](#custom-error-messages)
    4. [Validation Action](#callback-for-successful-validation)
    5. [Validation Instance](#create-the-validation-instance)
    6. [Markup a Form](#create-a-form-somewhere-in-your-theme)
    7. [Retrieve User Input](#retrieve-user-input)
    8. [Retrieve Errors](#retrieve-error-messages)

## Basic example

`functions.php` or in some plugin:
```php
<?php

// declare the rules
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'email'      => ['required', 'email']
  )
);

// hook for validation pass
function my_form_valid( $form ) {
  echo 'my_form user input validated. Do something...'
}
add_action( $my_form['action'], 'my_form_valid' );

// activate the form
wfv_create( $my_form );

```
Theme template:
```php
<form name="contact_form" method="post">

  <input id="email" name="email" type="text">

  <input type="hidden" name="action" value="contact_form">

  <?= $my_form->get('nonce_field'); ?>

  <input type="submit" value="Submit">
</form>
```
<br>

---

## Introduction

Intended for developers who want to build forms in a theme using custom markup and validate the input in a declarative way.

### The Problem:
Working with custom forms in WordPress presents several challenges:

The [WordPress way](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_post_%28action%29)  is to create an action hook that triggers after a http request to `/wp-admin/admin-post.php`

This means when the form is submitted, the user is sent to `http://yoursite.com/wp-admin/admin-post.php`.

Why is this a problem?

For starters, the user is no longer on your form, and to send them back (i.e they missed a required field) we need make a  `HTTP Request` and redirect them back. At this point the `$_POST` with their input is gone, which would have been useful to repopulate the form. In order to persist the users input you need to either append a url query to the redirect to make it available in `$_GET`,  or store it in a session or cookie.

Neither is elegant, and both are clunky.

Far too common the solution to `SELF_POST` the form is to capture the `$_POST` and run the logic in a template file. Albeit this solves the redirect problem, having logic in a template file is a poor separation of concerns and an anti-pattern.

This gets messy and confusing fast.

Most form building plugins have large footprints that generate rendered markup configured through the admin dashboard. Although it sounds much easier to point and click, and drag and drop; until something breaks or it can't meet some specific requirement. Enter hacks...

### The Solution:
WFV gives you the ability to declare form validation constraints in a similar way found in MVC frameworks such as [Laravel](https://laravel.com/).

Markup a form in a template and define its constraints in `functions.php` or a plugin.

WFV uses [Valitron](https://github.com/vlucas/valitron) as the validation library.

## Features
Just a library to handle form input validation with WordPress.

...nothing more, nothing less

* 32 built-in validation rules from [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules)
* Create custom rules
* Default and custom error messages
* Self POST. No redirects, GET vars, sessions, or cookies
* Declarative API
* None intrusive and lightweight
* Stays away from your admin dashboard
* No rendered markup
* Developer freedom

## TODO:
- Expose an api for the front end to support singe configuration.
- Standardize storage for default error messages.

# Install

Currently there is no release available.

Under active development

If you can't wait, install as development.

`$ git clone` inside `./wp-content/plugins`

`$ composer install`

Once a release is packaged, install will be the usual WordPress way.

# Usage

## Configure validation rules:

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'name'      => ['required'],
    'email'     => ['required', 'email'],
  )
);
```

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron) doc.

## Custom validation rules:

Prepend `custom:` to rule, name of rule is the callback.
```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'name'      => ['required'],
    'email'     => ['required', 'email'],
    'phone'     => ['required', 'custom:phone']
  )
);
```
Create the callback:
```php
<?php
// phone field will validate only if the input is 'hi' ...how cruel
function wfv__phone( $value ) {
  return ( 'hi' === $value ) ? true : false;
}
```

## Custom error messages:

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'name'      => ['required'],
    'email'     => ['required', 'email'],
    'website'   => ['url'],
    'msg'       => ['required']
  ),

  // override an error msg
  'messages' => [
    'email' => array(
      'required' => 'Your email is required so we can reply back'
    ),
    'website' => array(
      'url' => 'The website url is invalid'
    )
  ]
);
```

## Callback for successful validation:

```php
<?php
function my_form_valid( $form ) {
  // form validated, do something...
  echo $form->input('name');
  echo $form->input('email');
}
add_action( $my_form['action'], 'my_form_valid' );
```

## Create the validation instance:
### `wfv_create( array $form )`

Creates and assigns by reference the validation instance.

```php
<?php
// $my_form becomes an instance of WFV_Form
wfv_create( $my_form );
```
You can now access methods available to `WFV_Form`

## Create a form somewhere in your theme:

```php
<form name="contact_form" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="email" type="text">
  <input id="website" name="website" type="text">
  <textarea id="msg"></textarea>

  <input type="hidden" name="action" value="<?php echo $my_form->get('action'); ?>">
  <?php echo $my_form->get('nonce_field'); ?>
  <input type="submit" value="Submit">
</form>
```

The form must have these two tags:

Hidden action field with the unique value for this form:


`<input type="hidden" name="action" value="<?php echo $my_form->get('action'); ?>">`

The nonce field:

`<?php echo $my_form->get('nonce_field'); ?>`

## Retrieve user input:
### `input( string $field = null )`

```php
<?php
/**
 * Convenience method to access input property
 *
 * @param string (optional) $field Name of field
 * @return class|string Instance of WFV_Input or field value
 */
```
```php
<?php // useful to repopulate field(s)
echo $my_form->input('email'); // foo@bar.com
```

Assign input instance to a variable:
```php
<?php
$input = $my_form->input(); // $input is now an instance of WFV_Input
echo $input->get('email'); // foo@bar.com
```

The above are shorthands for:
```php
<?php
echo $my_form->get('input')->get('email'); // foo@bar.com

```

Get input as an array:
```php
<?php
$input = $my_form->input()->get_array();
echo $input['email']; // foo@bar.com
```

## Check if input has some specific value:
### `has( string $needle, string $property = null )`

```php
<?php
/**
 * Check if field or input has $string
 *
 * @param string $needle Search string
 * @param string (optional) $property Name of field
 * @return bool
 */
```

```php
<?php
$my_form->get('input')->has('foo@bar.com', 'email');  // true
$my_form->get('input')->has('bar@foo.com', 'email');  // false
$my_form->get('input')->has('foo@bar.com');  // true
```

**Access using `input()` shorthand from `WFV_Form` instance.**

It is recommended to access `has()` using the `input()` convenience method from the instance of `WFV_Form`. Your code will be more declarative and self documenting.

Check if a field has specific string:
```php
<?php
$my_form->input('email')->has('foo@bar.com');  // true
$my_form->input('email')->has('bar@foo.com');  // false
```

Check entire input for a specific string:
```php
<?php // will evaluate true if any field has 'foo@bar.com'
$my_form->input()->has('foo@bar.com');  // true
```

**Warning:** If no field name is supplied, `has()` will return `TRUE` on the first match. It is only useful to do this if looking for a unique value that could be in any field. Specifying a field name is more reliable.



## Retrieve error messages:
### `error( string $field = null )`

```php
<?php
/**
 * Convienience method to access errors property
 * Default returns decorated instance of WFV_Errors
 * If $field supplied, returns fields first error
 *
 * @param string (optional) $field Name of field
 *
 * @return class|string WFV_Errors instance or first error string
 */
```


Get first error message on field:
```php
<?php // get the first error message on the field
echo $my_form->error('email'); // Your email is required so we can reply back
```

First error message is the first rule declared.


eg. `required` is the first error if rules are declared: `['required', 'email']` and both validations fail.


Get all errors:
```php
<?php // get a decorated instance of `WFV_Errors`
$errors = $my_form->error();
```

Get field errors:
```php
<?php // get the error bag for a field

$errors = $my_form->error();
$email_errors = $errors->get('email');

foreach( $email_errors as $error ) {
  echo $error;
}
```

```php
<?php // Or chain...
$email_errors = $my_form->error()->get('email');
```


### Note:

You can create unlimited forms as long as each has a unique `action` value.

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
