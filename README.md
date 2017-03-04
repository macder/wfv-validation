# wp-form-validation

Description soon...


## Install

To be honest, if you don't know how to install a WordPress plugin, this isn't for you.

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
