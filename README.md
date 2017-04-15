# WFV
## WordPress Form Validation

#### *Declarative input validation API for WordPress*

Intended for developers who want to build forms in a theme using custom markup and validate the input in a declarative way.


# Table of Contents
* [Basic Example](#basic-example)
* [Problem](#problem)
* [Solution](#solution)
* [Features](#features)
* [TODO](#todo)
* [Install](#install)
* [Usage](#usage)
  * [Rules](#configure-validation-rules)
  * [Custom Rules](#custom-validation-rules)
  * [Custom Error Messages](#custom-error-messages)
  * [Validation Action](#callback-for-successful-validation)
  * [Markup a Form](#create-a-form-somewhere-in-your-theme)
  * [Validation Instance](#create-the-validation-instance)
  * [Retrieve User Input](#retrieve-user-input)
  * [Checkboxes and Radio](#checkboxes-and-radio)
  * [Select and multi-select](#select-and-multi-select)
  * [Working with Errors](#working-with-errors)


## Basic example

`functions.php` or in some plugin:
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

// hook for validation pass
add_action( $my_form['action'], 'my_form_valid' );
function my_form_valid( $form ) {
  // form validated, do something...
}

// activate the form
wfv_create( $my_form );

```
Theme template:
```html
<form method="post">
  <input name="first_name" type="text">
  <input name="email" type="text">
  <?php $my_form->get_token_fields(); ?>
  <input type="submit" value="Send">
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

The user is no longer on the form. To send them back (i.e missed required field), we need to redirect. Now the `$_POST` with the input is gone... that would have been useful to repopulate the form. In order to persist that input, it needs to be stored in `GET`, or in the browser as a session or cookie.

Neither is elegant, both are clunky.

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
* Sanitized input return
* Repopulate fields, including [checkbox/radio](#checkboxes-and-radio) and [multi-selects](#select-and-multi-select)
* Action hook for validation success
* Self POST - no redirects, no GET vars, no sessions, no cookies
* Declarative object oriented API
* None intrusive and lightweight
* Stays away from your admin dashboard
* No rendered markup
* Developer freedom

## TODO
- API endpoint for front end - support single configuration.

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

## Callback for successful validation

When the input validates, i.e. passes all the constraints, the action hook defined in `$my_form['action']` is triggered.

Hook into it, do some logic in the callback:

```php
<?php

add_action( 'contact_form', 'contact_form_valid' );
function contact_form_valid( $form ) {
  // form validated, do something...
  echo $form->input->name;
  echo $form->input->email;
}
// that was better than using conditionals...
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

## Retrieve user input
### `WFV\Input`

```php
<?php // input property is an instance of WFV\Input

$input = $my_form->input;
```

Get the input from a field:
```php
<?php // output the value the user entered into the email field

echo $my_form->input->email; // foo@bar.com

```

Get input as an array:
```php
<?php // get users input as an associative array

$input = $my_form->input->get_array();
echo $input['email']; // foo@bar.com
```

## Checkboxes and Radio
### `checked_if( string $field, string $needle )`
Return string `'checked'` when `$field` has input `$needle`.

```php
<?php
/**
 * Convenience method to repopulate checkbox or radio.
 * Returns 'checked' string if field has value in POST.
 *
 * @param string $field Field name.
 * @param string $needle Value to compare against.
 * @return string|null
 */
```

Available to the `WFV\Validator` instance:
```php
<?php // will echo 'checked' if user checked 'green' checkbox

echo $my_form->checked_if('color', 'green'); // checked

```

**Repopulate:**

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

## Select and multi-select
### `selected_if( string $field, string $needle )`
Return string `'selected'` when `$field` has input `$needle`.

```php
<?php
/**
 * Convenience method to repopulate select input.
 * Returns 'selected' string if field has value in POST.
 *
 * @param string $field Field name.
 * @param string $needle Value to compare against.
 * @return string|null
 */
 ```
Available to the `WFV\Validator` instance:
```php
<?php // will echo 'selected' if user selected 'green' in select input

echo $my_form->selected_if('color', 'green'); // selected
```

**Repopulate:**

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


## Working with errors
### `WFV\Errors`

```php
<?php // errors property is an instance of WFV\Errors

$errors = $my_form->errors;
```

Check if field has an error:
```php
<?php // does the email field have an error?

$my_form->errors->has('email'); // true or false
```

Get field errors:
```php
<?php // get the error bag for a field

$email_errors = $my_form->errors->email;

foreach( $email_errors as $error ) {
  echo $error;
}
```


### `error( string $field )`
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
