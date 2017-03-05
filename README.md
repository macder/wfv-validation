# wp-form-validation

** WORK IN PROGRESS **

Release date: TBD

Provides your theme with an easy way to perform backend form input validation

MVC framework like [Laravel](https://laravel.com/) or [CodeIgniter](https://codeigniter.com/) provide an intuitive and simple class to validate forms. [WordPress](https://wordpress.org/) falls short, leaving much to be desired. Aside from some general [sanitation methods](https://codex.wordpress.org/Data_Validation), validation for custom forms can be a pain.

We want to be able to create and array of rules, attach it to a form, and pass it off to a validator, just as we would with most MVC's. Nobody has time to deal with all the details that come with data validation and feedback.

wp-form-validation solves this shortfall by introducing a form validation class.

In a nutshell, it's an interface for [Valitron](https://github.com/vlucas/valitron), but all you need to do is instantiate the `Form_Validation` class, pass in the rules array with form name.

Boom


## Install

Currently there is still no Release

Until then, install for development

`$ git clone` inside `./wp-content/plugins`

`$ composer install`

Once a release is packaged, install will be the usual WordPress way

## Getting Started

Create a form somewhere in your theme:
```
<form name="contact_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="org" type="text">
  <textarea id="msg"></textarea>
  <input type="submit" value="Submit">
</form>
```

Set rules and instantiate validation class in functions.php, or wherever it makes sense:

```
$form_name = 'contact';

$rules = array(
  'name' => [ 'required' ],
  'email'=> [ 'email', 'required' ]
);

new Form_Validation( $form_name, $rules );
```

For available validation rules, reference the [Valitron](https://github.com/vlucas/valitron) doc

## Development

`$ git clone` inside `./wp-content/plugins`

`$ composer install`
