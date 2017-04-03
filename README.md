# WPFV
## WordPress Form validation

** WORK IN PROGRESS **

Release date: TBD

Provides your theme with an easy way to perform backend form input validation

MVC framework like [Laravel](https://laravel.com/) or [CodeIgniter](https://codeigniter.com/) provide an intuitive and simple class to validate forms. [WordPress](https://wordpress.org/) falls short, leaving much to be desired. Aside from some general [sanitation methods](https://codex.wordpress.org/Data_Validation), validation for custom forms can be a pain.

We want to be able to create and array of rules, attach it to a form, and pass it off to a validator, just as we would with most MVC's. Nobody has time to deal with all the details that come with data validation and feedback.

wp-form-validation solves this shortfall by introducing a form validation class.

In a nutshell, it's an interface for [Valitron](https://github.com/vlucas/valitron), but all you need to do is instantiate the `Form_Validation` class, pass in the rules and an identifier for the form.

Boom

## TODO:
- Expose an api for the front end to support singe configuration.
- Support for custom validation rules.
- Store validation result in session or cookie to eliminate ugly url query.
- Standardize storage for default error messages.

## Install

Currently there is no release available.

Under active development - Not recommended for usage yet. Major changes are introduced frequently.

If you can't wait, install as development.

`$ git clone` inside `./wp-content/plugins`

`$ composer install`

Once a release is packaged, install will be the usual WordPress way.

## Getting Started


### Configure the validation rules:

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

### Set custom error messages:

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

### Create a new validation instance for the form:

```php
<?php
wfv_create( $my_form );

print_r( $my_form );
```
This will create a new validation instance and assign by reference the form config as an object.


### Create callback function to execute when validation is successful:

```php
<?php
function my_form_valid( $input ) {
  // form validated, do something...
  echo $input['name'];
  echo $input['email'];
}
add_action( $my_form->action, 'my_form_valid' );
```

### Create a form somewhere in your theme:
```html
<form name="contact_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="email" type="text">
  <input id="website" name="website" type="text">
  <textarea id="msg"></textarea>

  <input type="hidden" name="action" value="<?= $my_form->action ?>">
  <?= $my_form->nonce_field ?>
  <input type="submit" value="Submit">
</form>
```

The unique identifier for the form is the action value.
```html
<input type="hidden" name="action" value="<?= $my_form->action ?>">
```
It connects the form to the configuration defined in `$my_form`.

If validation fails, the `input` property on the form config object will be an array of sanitized key/value pairs the user submitted.

Use it to re-populate the form.

eg:
```html
<input id="name" name="name" type="text" value="<?= $my_form->input['name']; ?>">
```

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
