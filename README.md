# API Demo

How to create APIs in Laravel?

## Using ApiController

See the first part in api.php and Http/Controllers/Api/UserController

## Basic route

See the second part in api.php and Http/Controllers/Api/UserController

## Sanctum Authentication

See the third part in api.php and:

- Http/Controllers/Api/RegisterController for registration
- Http/Controllers/Api/SanctumUserController for usage

The base response is in the Http/Traits/BaseApiResponse.php

## JWT Tokens

This demo project uses PHP-JWT: https://github.com/firebase/php-jwt

See the JWTController for this example.

## API documentation

This project uses Scribe: https://scribe.knuckles.wtf/laravel

To generate html docs use:

```
php artisan scribe:generate
```

and see /docs route
