# wp-form-validation

** WORK IN PROGRESS **

Release date: TBD

Provides your theme with an easy way to perform backend form input validation

If you worked with an MVC framework like [Laravel](https://laravel.com/) or [CodeIgniter](https://codeigniter.com/), then you know how easy form validation is.

[WordPress](https://wordpress.org/) doesn't provide much for elegant validation, just some general [sanitation methods](https://codex.wordpress.org/Data_Validation).

We want to be able to create and array of rules, attach it to a form, and pass it off to a validator, just as we would with most MVC's.

wp-form-validation solves this WordPress shortfall by introducing a form validation class.

In a nutshell, it's an interface for [GUMP](https://github.com/Wixel/GUMP), but all you need to do is instantiate the `Form_Validation` class and pass in the rules array and form name.

Boom


## Install

If you don't know how to install a WordPress plugin, this isn't for you.

## Getting Started

Create a form somewhere in your theme:
```
<form name="contact_form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
  <input id="name" name="name" type="text">
  <input id="email" name="org" type="text">
  <textarea id="msg"></textarea>
</form>
```

Set rules and instantiate validation class in functions.php, or wherever it makes sense:

```
$form_name = 'contact';

$rules = array(
  'name'  => 'required|alpha_numeric',
  'email' => 'required|valid_email',
  'msg'   => 'required'
);

$form_validation = new Form_Validation($form_name, $rules);
```

## Development

`$ git clone` inside `./wp-content/plugins`

`$ composer install`
