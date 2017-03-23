# wp-form-validation

** WORK IN PROGRESS **

Release date: TBD

Provides your theme with an easy way to perform backend form input validation

MVC framework like [Laravel](https://laravel.com/) or [CodeIgniter](https://codeigniter.com/) provide an intuitive and simple class to validate forms. [WordPress](https://wordpress.org/) falls short, leaving much to be desired. Aside from some general [sanitation methods](https://codex.wordpress.org/Data_Validation), validation for custom forms can be a pain.

We want to be able to create and array of rules, attach it to a form, and pass it off to a validator, just as we would with most MVC's. Nobody has time to deal with all the details that come with data validation and feedback.

wp-form-validation solves this shortfall by introducing a form validation class.

In a nutshell, it's an interface for [Valitron](https://github.com/vlucas/valitron), but all you need to do is instantiate the `Form_Validation` class, pass in the rules and an identifier for the form.

Boom


## Install

Currently there is no release available

Under active development - Not recommended for usage yet

If you can't wait, install as development

`$ git clone` inside `./wp-content/plugins`

`$ composer install`

Once a release is packaged, install will be the usual WordPress way

## Getting Started

Create a form somewhere in your theme:
```html
<form name="contact_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="org" type="text">
  <textarea id="msg"></textarea>

  <input type="hidden" name="action" value="contact_form">
  <input type="submit" value="Submit">
</form>
```

The unique identifier for the form is the action value:

`<input type="hidden" name="action" value="contact_form">`


Set rules and instantiate validation class in functions.php, or wherever it makes sense.

Basic example:
```php
<?php

$action = 'contact_form'; // unique indenfier - value from hidden action field
$rules = array(
  'name' => [ 'required' ],
  'email'=> [ 'email', 'required' ]
);

// instantiate form validation
$validate_contact = new Form_Validation( $action, $rules );

// action for validation pass
add_action( 'valid_'.$action, 'valid_contact' );

function valid_contact($input) {
  // form validated, do something...
  echo $input['name'];
  echo $input['email'];
}

```

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron) doc

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
