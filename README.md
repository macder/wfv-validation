# wp-form-validation

Description soon...


## Install

...

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
