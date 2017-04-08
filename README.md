# WFV
## WordPress Form Validation

** WORK IN PROGRESS **

Release date: TBD

**Status**:
`API is near standardized; major changes are less frequent.`

Intended for developers who want to build forms in a theme using custom markup and validate the input in a declarative way.
*i.e. write your own markup for a form and define the constraints*

Working with custom forms in WordPress can be a pain. There is no rich validation API aside from some general [sanitation methods](https://codex.wordpress.org/Data_Validation) and most form building plugins have large footprints that generate rendered markup configured through the admin dashboard.


Without using a plugin, the [WordPress way](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_post_%28action%29) to capture `POST` or `GET` involves creating an action hook that a `REQUEST` to `/wp-admin/admin-post.php` will trigger. This method is not elegant because it sends the user to `/wp-admin/admin-post.php`. If we need to send them back (i.e they missed a field), another `HTTP Request` needs to be made to redirect them back to the form. At this point the `$_POST` with their input is gone, which would have been useful to repopulate the form. In order to persist the users input you need to either create a url query and append it to the redirect and access it from `$_GET`, or store it in a session or cookie.

A common solution to `POST` to the same url the form is on is to capture the `$_POST` and run logic on it in a template file. Albeit this solves the redirect problem, having logic in a template file is a poor separation of concerns and an anti-pattern.

WFV gives you the ability to declare form validation constraints in a similar way found in MVC frameworks such as [Laravel](https://laravel.com/).

It does not introduce anything into the admin dashboard. The idea is to define a form and its constraints in a themes `functions.php` or plugin. The markup and behavior of the form is left for the developer.

In a nutshell, you define the rules and error messages for each field in an array and send it to a validator. The validator will assign by reference an instance of itself to the form definition it receives.

WFV uses [Valitron](https://github.com/vlucas/valitron) as the validation library.

## Features:
Just a library to handle form input validation with WordPress.

...nothing more, nothing less

* 32 built-in validation rules from [Valitron](https://github.com/vlucas/valitron#built-in-validation-rules)
* Default and custom error messages
* Posts to self url. No redirects, GET vars, sessions, or cookies
* None intrusive and lightweight
* Stays away from your admin dashboard
* No rendered markup
* Developer freedom

## TODO:
- Expose an api for the front end to support singe configuration.
- Support for custom validation rules.
- Standardize storage for default error messages.

## Install

Currently there is no release available.

Under active development - Not recommended for usage yet. Major changes are introduced frequently.

If you can't wait, install as development.

`$ git clone` inside `./wp-content/plugins`

`$ composer install`

Once a release is packaged, install will be the usual WordPress way.

## Usage


### Configure validation rules:

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'name'      => ['required'],
    'email'     => ['email', 'required'],
    'website'   => ['required', 'url'],
    'msg'       => ['required']
  )
);
```

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron) doc.

### Custom error messages:

```php
<?php
$my_form = array(
  'action'  => 'contact_form', // unique identifier
  'rules'   => array(
    'name'      => ['required'],
    'email'     => ['email', 'required'],
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

### Callback for successful validation:

```php
<?php
function my_form_valid( $form ) {
  // form validated, do something...
  echo $form->get_input('name');
  echo $form->get_input('email');
}
add_action( $my_form['action'], 'my_form_valid' );
```

### Create the validation instance:
`wfv_create( array $form )`

Creates a validation instance for the form assign self by reference to the array parameter.

```php
<?php // $my_form becomes an instance of WFV_Form
wfv_create( $my_form );
```
You can now access `WFV_Form` methods

`get( string $property )`
```php
<?php
echo $my_form->get('action'); // contact_form
```

`get_input( $field )`
```php
<?php // useful to repopulate form
echo $my_form->get_input('email'); // foo@bar.com
```


### Create a form somewhere in your theme:

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

### Retrieving error messages:
`get_error( string $field_name = null, bool $bag = false )`

Get all errors:
```php
<?php // returns array with all errors
$errors = $my_form->get_error();
```

Get field errors:
```php
<?php // returns error array for a field
$email_errors = $my_form->get_error( 'email', $bag = true );
```

Get field's first error message
```php
<?php // returns first error message string for field
echo $my_form->get_error( 'email' ); // Your email is required so we can reply back
```
First error message is the first rule declared.   
eg. `'required'` is the first error when rules are declared as:
`['required', 'email']` and both validations fail.


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
