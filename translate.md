# Translate v0ltureDB
Help translate v0ltureDB into more languages to make it more friendly for all to use.

## Structure
Your translation language must be unique.
If someone has already done it you may improve it.

Declare the language code, a friendly name, and the version supported in your `$lang_properties` array.
```php
$lang_properties = Array(
  'friendly' => "English US",
  'code' => "EN",
  'supports' => "0.0.1.14",
);
```

Build your translation based on the `en.php` language file and submit it as PR to add it into the project.
