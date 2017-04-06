# WFV
## WordPress Form Validation

** WORK IN PROGRESS **

Release date: TBD

Intended for developers who want to build forms in a theme using custom markup and validate the input in a declarative way.   
*i.e. write your own markup for a form and define the constraints*

Working with custom forms in WordPress can be a pain. There is no rich validation API aside from some general [sanitation methods](https://codex.wordpress.org/Data_Validation) and most form building plugins have large footprints that generate rendered markup configured through the admin dashboard.


Without using a plugin, the [WordPress way](https://codex.wordpress.org/Plugin_API/Action_Reference/admin_post_%28action%29) to capture `POST` or `GET` involves creating an action hook that a `REQUEST` to `/wp-admin/admin-post.php` will trigger. This method is not elegant because it sends the user to `/wp-admin/admin-post.php`. If we need to send them back (i.e they missed a field), another `HTTP Request` needs to be made to redirect them back to the form. At this point the `$_POST` with their input is gone, which would have been useful to repopulate the form. In order to persist the users input you need to either create a url query and append it to the redirect and access it from `$_GET`, or store it in a session or cookie.

A common solution `POST` to the same url the form is on is to capture the `$_POST` and run logic on it in a template file. Albeit this solves the redirect problem, having logic in a template file is a poor separation of concerns and an anti-pattern.

WFV gives you the ability to declare form validation constraints in a similar way found in MVC frameworks such as [Laravel](https://laravel.com/).

It does not introduce anything into the admin dashboard. The idea is to define a form and its constraints in a themes `functions.php` or plugin. The markup and behavior of the form is left for the developer.

In a nutshell, you define the rules and error messages for each field in an array and send it to a validator. The validator will assign by reference an instance of itself to form definition it receives.


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

## Getting Started


### 1) Configure validation rules:

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

### 2) Custom error messages:

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

### 3) Callback for successful validation:

```php
<?php
function my_form_valid( $input ) {
  // form validated, do something...
  echo $input['name'];
  echo $input['email'];
}
add_action( $my_form['action'], 'my_form_valid' );
```

### 4) Create the validation instance:


```php
<?php
wfv_create( $my_form ); // $my_form is now an instance of `WFV_Form`

print_r( $my_form );
```

### 5) Create a form somewhere in your theme:
```html
<form name="contact_form" action="" method="post">
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
