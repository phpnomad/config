# phpnomad/config

[![Latest Version](https://img.shields.io/packagist/v/phpnomad/config.svg)](https://packagist.org/packages/phpnomad/config)
[![Total Downloads](https://img.shields.io/packagist/dt/phpnomad/config.svg)](https://packagist.org/packages/phpnomad/config)
[![PHP Version](https://img.shields.io/packagist/php-v/phpnomad/config.svg)](https://packagist.org/packages/phpnomad/config)
[![License](https://img.shields.io/packagist/l/phpnomad/config.svg)](https://packagist.org/packages/phpnomad/config)

`phpnomad/config` is a strategy-based configuration layer for PHP applications. It splits configuration into two separate concerns, one for how values are stored and looked up and another for how files are read from disk. Both live behind interfaces, so you can change either one without touching the code that consumes configuration values.

The package defines `ConfigStrategy` for storage and lookup, `ConfigFileLoaderStrategy` for file loading, and a `ConfigService` that ties them together. Keys are accessed with dot-notation, so nested structures like `app.mailer.host` work out of a single `get` call. The base package has no runtime dependencies. Concrete file-loading backends live in separate packages.

## Installation

```bash
composer require phpnomad/config
```

## Quick Start

Once you have a `ConfigStrategy` implementation, register a namespace of config data and read values back with dot-notation keys.

```php
use PHPNomad\Config\Interfaces\ConfigStrategy;

/** @var ConfigStrategy $config */
$config->register('app', [
    'debug'  => false,
    'locale' => 'en_US',
    'mailer' => [
        'host' => 'smtp.example.com',
        'port' => 587,
    ],
]);

$config->get('app.debug');              // false
$config->get('app.mailer.host');        // 'smtp.example.com'
$config->get('app.mailer.timeout', 30); // 30 (default fallback)
$config->has('app.mailer.host');        // true
```

`ConfigStrategy` is an interface. Pair it with a concrete implementation like [`phpnomad/json-config-integration`](https://packagist.org/packages/phpnomad/json-config-integration) for JSON files, or [`phpnomad/array-json-config`](https://packagist.org/packages/phpnomad/array-json-config) for a basic arrays and JSON setup. You can also implement `ConfigStrategy` directly against any storage backend you need.

## Key Concepts

- `ConfigStrategy` registers a top-level key with an array of config data and reads single values with dot-notation lookups. `get()` accepts a default for missing keys. `has()` reports whether a key resolves to a value.
- `ConfigFileLoaderStrategy` turns a file path into an array of configuration data. This keeps file-format decisions (JSON, PHP, YAML, or anything else) separate from how the data is stored.
- `ConfigService` takes a `ConfigStrategy` and a `ConfigFileLoaderStrategy` in its constructor. Call `registerConfig($key, $path)` to load a file through the loader and register its contents under a namespace in the strategy.
- `ConfigException` is raised when loading or registering configuration fails, so consumers have a single exception type to catch around config setup.

## Documentation

Full documentation, including the interface contracts and guidance on writing your own strategies, lives at [phpnomad.com](https://phpnomad.com).

## License

MIT. See [LICENSE.txt](LICENSE.txt).
