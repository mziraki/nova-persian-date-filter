# Laravel Nova Persian Date Filter

A persian/jalali date/datetime resource filter for Laravel Nova

## Requirements

- `php: ^8.0`
- `laravel/nova: ^4.0`

## Installation

Install the package into a Laravel app that uses [Nova](https://nova.laravel.com) with Composer:

```bash
composer require mziraki/nova-persian-date-filter
```

## Usage

Extend `MZiraki\PersianDateFilter\PersianDateFilter`:

```php
use MZiraki\PersianDateFilter\PersianDateFilter;

class DueOn extends PersianDateFilter
{...}
```

Add the field to your resource in the ```filters``` method:

```php
use App\Nova\Filters\DueOn;

DueOn::make()
    ->color('rgb(30, 136, 229)') // customize color
    ->locale('fa,en') // customize locale
    ->type('date'), // date or datetime
```

The filter extends the `Laravel\Nova\Filters\Filter` filter, so all the usual methods are available.

## Credits

- [Vue Persian DateTime Picker](https://github.com/talkhabi/vue3-persian-datetime-picker)
