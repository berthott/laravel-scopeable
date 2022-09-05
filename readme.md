# Laravel-Scopeable - A helper for permission scopes in Laravel

This is a helper to add permission scopes to your model by adding a trait. It's used by [laravel-crudable](https://github.com/berthott/laravel-crudable).

## Installation

```
$ composer require berthott/laravel-scopeable
```

## Usage

* Create your table and corresponding model, eg. with `php artisan make:model YourModel -m`
* Add the `Scopeable` Trait to your newly generated model.
* Relate your scopeable model to your User class.
* Now you can use Scopeable::checkScopes() to check whether the currently logged in user has the same scope as the requested resource or Scopeable::filterScopes() to filter a collection for models matching the currently logged in users scopes.

## Options

To change the default options use
```
$ php artisan vendor:publish --provider="berthott\Scopeable\ScopeableServiceProvider" --tag="config"
```
* `namespace`: string or array with one ore multiple namespaces that should be monitored for the Scopeable-Trait. Defaults to `App\Models`.
* `namespace_mode`: Defines the search mode for the namespaces. `ClassFinder::STANDARD_MODE` will only find the exact matching namespace, `ClassFinder::RECURSIVE_MODE` will find all subnamespaces. Defaults to `ClassFinder::STANDARD_MODE`.

## Compatibility

Tested with Laravel 9.x.

## License

See [License File](license.md). Copyright © 2022 Jan Bladt.