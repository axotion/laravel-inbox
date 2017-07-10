# laravel-inbox
### It's a very early alpha of this project so be aware of bugs 

A simple message system for laravel 5.x

[![Latest Stable Version](https://poser.pugx.org/evilnet/inbox/v/stable)](https://packagist.org/packages/evilnet/inbox)
[![Total Downloads](https://poser.pugx.org/evilnet/inbox/downloads)](https://packagist.org/packages/evilnet/inbox)
[![Latest Unstable Version](https://poser.pugx.org/evilnet/inbox/v/unstable)](https://packagist.org/packages/evilnet/inbox)
[![License](https://poser.pugx.org/evilnet/inbox/license)](https://packagist.org/packages/evilnet/inbox)

## Install

#### Via Composer

``` bash
$ composer require evilnet/inbox
```

* or manually add  
```
"evilnet/inbox": "dev-master"
```
 to require-dev and then type composer install/update

* Register new service in your app.php
```
Evilnet\Inbox\InboxServiceProvider::class
```

* After that type 
```
php artisan vendor:publish --tag=migrations 
php artisan migrate
```

#### Done
## Usage


There are predefined routes:
 ``` 
 Route::get('conversation', 'Evilnet\Inbox\InboxController@create');
 
    Route::post('conversation', 'Evilnet\Inbox\InboxController@store');
    Route::get('conversation/{id}', 'Evilnet\Inbox\InboxController@show');
    Route::post('message/{id}', 'Evilnet\Inbox\InboxController@addMessage');
    Route::get('inbox', 'Evilnet\Inbox\InboxController@index')->name('inbox');
    Route::delete('/conversation/{id}', '\Evilnet\Inbox\InboxController@destroy');
```    
Before test it you must add implementation of auth system. Basically you can do: 
```
php artisan make:auth
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email axotion@linux.pl instead of using the issue tracker.

## Credits

- [axotion][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/axotion/inbox.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/axotion/inbox/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/axotion/inbox.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/axotion/inbox.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/axotion/inbox.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/axotion/inbox
[link-travis]: https://travis-ci.org/axotion/inbox
[link-scrutinizer]: https://scrutinizer-ci.com/g/axotion/inbox/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/axotion/inbox
[link-downloads]: https://packagist.org/packages/axotion/inbox
[link-author]: https://github.com/axotion
[link-contributors]: ../../contributors
