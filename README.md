# BladeSlim

Integration of Blade Template Engine with Slim Framework

[![Latest Stable Version](http://poser.pugx.org/caiquebispo/blade-slim/v)](https://packagist.org/packages/caiquebispo/blade-slim) [![Total Downloads](http://poser.pugx.org/caiquebispo/blade-slim/downloads)](https://packagist.org/packages/caiquebispo/blade-slim) [![Latest Unstable Version](http://poser.pugx.org/caiquebispo/blade-slim/v/unstable)](https://packagist.org/packages/caiquebispo/blade-slim) [![License](http://poser.pugx.org/caiquebispo/blade-slim/license)](https://packagist.org/packages/caiquebispo/blade-slim) [![PHP Version Require](http://poser.pugx.org/caiquebispo/blade-slim/require/php)](https://packagist.org/packages/caiquebispo/blade-slim)

A package that seamlessly integrates Laravel’s Blade templating engine with the Slim Framework, providing a smooth development experience with full Blade features in Slim applications.

## Installation

Install via Composer:

```bash
composer require caiquebispo/blade-slim
```

## Quick Setup

Configure Blade in your Slim application:

```php
use BladeSlim\Blade;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

// Blade Configuration
$blade = new Blade(
    __DIR__ . '/../resources/views', // Views directory
    __DIR__ . '/../storage/cache',   // Cache directory
    $app->getResponseFactory()->createResponse() // Response prototype
);
```

Create your first view in `resources/views/home.blade.php` and make sure the `storage/cache` folder is writable:

```blade
<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>Welcome to {{ $appName }}!</h1>
</body>
</html>
```

Use it in a route:

```php
$app->get('/', function () {
    return view('home', [
        'title' => 'Home Page',
        'appName' => 'My Slim App'
    ]);
});
```

## Key Features

### Global `view()` Function

Automatically returns a ready PSR-7 response.

Supports data, status codes, and headers:

```php
return view('error', ['message' => 'Not Found'], 404);
```

### Full Blade Support

- Template inheritance (`@extends`)
- Sections (`@section`, `@yield`)
- Components (`@component`)
- Custom directives
- Sub-view inclusion (`@include`)

### Flexible Configuration

- Multiple view paths
- Optional caching
- Integration with Slim's DI container

## Advanced Usage

### Custom Directives

```php
$blade->getFactory()->directive('datetime', function ($expression) {
    return "<?php echo ($expression)->format('d/m/Y H:i'); ?>";
});
```

## Contributing

Contributions are welcome! Follow these steps:

1. Fork the project
2. Create your branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

## 📧 Contact

Caique Bispo - caiquebispodanet86@gmail.com

Project Link: [https://github.com/caiquebispo/blade-slim](https://github.com/caiquebispo/blade-slim)
