# wp-form-validation

** WORK IN PROGRESS **

Release date: TBD

Provides your theme with an easy way to perform backend form input validation

If you have ever worked with an MVC framework like [Laravel](https://laravel.com/) or [CodeIgniter](https://codeigniter.com/), then you know how easy form validation is.

[WordPress](https://wordpress.org/) doesn't provide much for elegant validation, just some general [sanitation methods](https://codex.wordpress.org/Data_Validation).

We want to be able to create and array of rules, attach it to a form, and pass it off to a validator, just as we would with most MVC's.

wp-form-validation solves this WordPress shortfall by introducing a form validation class.

In a nutshell, it's an interface for [GUMP](https://github.com/Wixel/GUMP), but all you need to do is instantiate the `Form_Validation` class and pass in the rules array and form name.

Boom


## Install

If you don't know how to install a WordPress plugin, this isn't for you.

## Getting Started

functions.php example:

```
$form_name = 'contact';

$rules = array(
  'name' => 'required|alpha_numeric',
  'email' => 'required|valid_email'
);

$form_validation = new Form_Validation($form_name, $rules);
```

## Development

`$ git clone` inside `./wp-content/plugins`

`$ composer install`
