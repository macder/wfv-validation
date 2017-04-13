# WFV
## WordPress Form Validation

#### *Declarative input validation API for WordPress*

Intended for developers who want to build forms in a theme using custom markup and validate the input in a declarative way.


# Table of Contents
1. [Basic Example](#basic-example)
2. [Problem](#problem)
3. [Solution](#solution)
4. [Features](#features)
5. [TODO](#todo)
6. [Install](#install)
7. [Usage](#usage)
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
  'action'  => 'contact_form',
  'rules'   => array(
    'name'       => ['required'],
    'email'      => ['required', 'email']
  )
);

// hook for validation pass
function my_form_valid( $form ) {
  // form validated, do something...
}
add_action( $my_form['action'], 'my_form_valid' );

// activate the form
wfv_create( $my_form );

```
Theme template:
```php
<form name="contact_form" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="email" type="text">
  <?php $my_form->get_token_fields(); ?>
  <input type="submit" value="Submit">
</form>
```
<br>

---


## Problem
Working with custom forms in WordPress presents several challenges:

WordPress does not have an elegant way to validate user input. It does not offer much beyond some general [sanitation methods](https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data).

And,

The [WordPress way](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_post_%28action%29) to work with `$_POST` is to create an action hook that triggers after a http request to `/wp-admin/admin-post.php`

This means when the form is submitted, the user is sent to `http://yoursite.com/wp-admin/admin-post.php`.

Why is this a problem?

The user is no longer on the form. To send them back (i.e a required field was missed), we need to do a HTTP redirect. At this point the `$_POST` with the input is gone... which would have been useful to repopulate the form. In order to persist the users input, it needs to be stored in `GET`, a session, or a cookie.

Neither is elegant, and both are clunky.

Far too common the solution to `SELF_POST` the form is to capture the `$_POST` and run the logic in a template file. Albeit this solves the redirect problem, having logic in a template file is a poor separation of concerns and an anti-pattern. It gets messy and confusing fast.

Most form building plugins have large footprints that generate rendered markup configured through the admin dashboard. Although it sounds much easier to point and click, and drag and drop; until something breaks or it can't meet some specific requirement. Enter hacks...

## Solution
WFV gives you the ability to declare form validation constraints in a similar way found in MVC frameworks such as [Laravel](https://laravel.com/).

Markup a form in a template and define its constraints in `functions.php` or a plugin.

WFV uses [Valitron](https://github.com/vlucas/valitron) as the validation library.

## Features
Just an API for input validation with WordPress.

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

## TODO
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

## Configure validation rules

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

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules) doc.

## Custom validation rules

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

## Custom error messages

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'name'      => ['required'],
    'email'     => ['required', 'email'],
    'msg'       => ['required']
  ),

  // override an error msg
  'messages' => [
    'email' => array(
      'required' => 'Your email is required so we can reply back'
    )
  ]
);
```

## Callback for successful validation

```php
<?php
function my_form_valid( $form ) {
  // form validated, do something...
  echo $form->input->name;
  echo $form->input->email;
}
add_action( $my_form['action'], 'my_form_valid' );
```

## Create the validation instance
### `wfv_create( array $form )`

Creates and assigns by reference an instance of `WFV\Validator`.

```php
<?php
// $my_form becomes an instance of WFV\Validator
wfv_create( $my_form );
```
You can now access methods available to `WFV\Validator`

## Create a form somewhere in your theme

```html
<form name="contact_form" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="email" type="text">
  <textarea id="msg" name="msg"></textarea>

  <?php $my_form->get_token_fields(); ?>
  <input type="submit" value="Submit">
</form>
```
The form must have the required token tag:
```php
<?php $my_form->get_token_fields(); ?>
```
This adds 2 hidden fields, nonce and action. The generated action field identifies the form to a validation instance.

## Retrieve user input
### `input( string $field = null )`

```php
<?php
/**
 * Convienience method into $this->input.
 * Makes access more declarative.
 * $this->input is an instance of WFV\Input.
 *
 * @param string (optional) $field Property to retrieve value from.
 * @return class|string WFV\Input or $field string value.
 */
```
```php
<?php // useful to repopulate field(s)
echo $my_form->input('email'); // foo@bar.com
//or
echo $my_form->input->email; // foo@bar.com
```

Assign input instance to a variable:
```php
<?php
$input = $my_form->input(); // $input is now an instance of WFV\Input
echo $input->email; // foo@bar.com
```

Get input as an array:
```php
<?php
$input = $my_form->input()->get_array();
echo $input['email']; // foo@bar.com
```

## Retrieve error messages
### `error( string $field = null )`

```php
<?php
/**
 * Convienience method to access errors property.
 * Default returns WFV\Errors instance.
 * If $field supplied, returns fields first error.
 *
 * @param string (optional) $field Name of field
 *
 * @return class|string Instance of WFV\Errors or first error string.
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
<?php // get the instance of `WFV\Errors`
$errors = $my_form->error();
```

Get field errors:
```php
<?php // get the error bag for a field

$errors = $my_form->error();
$email_errors = $errors->email;

foreach( $email_errors as $error ) {
  echo $error;
}
```

```php
<?php // Or chain...
$email_errors = $my_form->error()->email;
```


> **Note:**

> You can create unlimited forms as long as each has a unique `action` value.

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
