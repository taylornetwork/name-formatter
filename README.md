# Name Formatter for Laravel

A customizable name formatter class for Laravel.

## Install

Via Composer

``` bash
$ composer require taylornetwork/name-formatter
```

## Setup

Add the service provider to the providers array in `config/app.php`

``` php
'providers' => [
	
	TaylorNetwork\Formatters\Name\NameFormatterServiceProvider::class,
	
],
```

### Publish Config

``` bash
$ php artisan vendor:publish
```

This will add `nameformatter.php` to your `config` directory

## Usage

Create a new instance of the class by passing it an instance of `Illuminate\Eloquent\Model` and call `format()`

Let's say we have a Customer model at `App\Customer`

``` php
use Illuminate\Eloquent\Model

class Customer extends Model
{
	protected $fillable = [
		'first_name', 'last_name', 'address', 
	];
}
```

We want to add a `fullName` attribute to our customer. 
We can create a getAttribute method Laravel will use to create the attribute for us. 
See [Laravel Eloquent Documentation][link-laravel-doc] for more information.

``` php
use Illuminate\Eloquent\Model
use TaylorNetwork\Formatters\Name\Formatter;

class Customer extends Model
{
	protected $fillable = [
		'first_name', 'last_name', 'address', 
	];
	
	public function getFullNameAttribute()
	{
		$formatter = new Formatter($this);
		return $formatter->format();
	}
}
```

Get the customers full name

``` php
$customer = App\Customer::create([ 
	'first_name' => 'John',
	'last_name' => 'Doe',
	'address' => '123 Main Street'
]);

echo $customer->fullName;
```

Returns

``` php
'John Doe'
```

By default the `Formatter` class will concatenate the `first_name` attribute, a space and the `last_name` attribute.

### Available Methods

#### format ()

Returns formatted name.

#### map (string | array $field, string | null $modelField)

By default the `Formatter` class will look for a `first_name` and `last_name` attribute on the model it was passed. If the model you are passing it has different attribute names fot first and last names you can either pass an associative array to the `map` function or two strings.

For a model with a first name attribute named `fName` and a last name attribute named `lName`

``` php
$formatter = new TaylorNetwork\Formatters\Name\Formatter($model);

$formatter->map([ 'first_name' => 'fName', 'last_name' => 'lName' ])->format();

// OR

$formatter->map('first_name', 'fName')->map('last_name', 'lName')->format();
```

#### style (string $style)

By default the `Formatter` class will format names as `$first_name . ' ' . $last_name` 
You can override the style with the `style` function. `style` accepts a string with the formatting you would like `Formatter` to use

| Key | Description | Example: `'John Doe'` |
|:---:|:------------|:---------------------:|
| `'F'` | The full first name | `'John'` | 
| `'L'` | The full last name | `'Doe'` |
| `'f'` | The first initial | `'J'` |
| `'l'` | The last initial | `'D'` |

*Any other characters in the string will appear in the formatted name*

##### Examples

``` php
$model->first_name = 'John';
$model->last_name = 'Doe';

$formatter = new TaylorNetwork\Formatters\Name\Formatter($model);
```

To get the first initial and last name

``` php
$formatter->style('f L')->format();

// Returns

'J Doe'
```

To get the last initial, the first name

``` php
$formatter->style('l, F')->format();

// Returns

'D, John'
```

To get the first and last initials

``` php
$formatter->style('fl')->format();

// Returns

'JD'
```

You can even add other characters to the style string

``` php
$formatter->style('F_L')->format();

// Returns

'John_Doe'
```

Every key in the string is replaced, so you could do something like this. (Though I don't know why you would)

``` php
$formatter->style('fffF lllL')->format();

// Returns

'JJJJohn DDDDoe'
```

## Trait

This package also comes with a trait you can add to your models.

``` php
use Illuminate\Eloquent\Model
use TaylorNetwork\Formatters\Name\Traits\ModelNameFormat;

class Customer extends Model
{
	use ModelNameFormat;
	
	protected $fillable = [
		'first_name', 'last_name', 'address', 
	];
	
	public function getFullNameAttribute()
	{
		return $this-getNameFormatter()->format();
	}
}
```

### Usage

Usage is the same as the class above, however it will add `getNameFormatter()` to your models which will return an instance of the `Formatter` class. It also will allow you to override defaults in the model itself by overriding the properties in the `ModelNameFormat` trait.

``` php
use Illuminate\Eloquent\Model
use TaylorNetwork\Formatters\Name\Traits\ModelNameFormat;

class Customer extends Model
{
	use ModelNameFormat;
	
	protected $fieldMap = [ 
		'first_name' => 'firstName',
		'last_name' => 'lastName'
	];
	
	protected $formatStyle = 'L, F';

	protected $fillable = [
		'firstName', 'lastName', 'address', 
	];
	
	public function getFullNameAttribute()
	{
		return $this->getNameFormatter()->format();
	}
}
```

The `$fieldMap` and `$formatStyle` properties on the model will be called when `getNameFormatter()` is called so calling `map` and `style` in the model is not necessary.

## Config

Once you run `php artisan vendor:publish` the config file `nameformatter.php` will be in your `config` directory. There you can set the defaults you want in terms of format style, field map, etc.

## Credits

- Author: [Sam Taylor][link-author]


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[link-author]: https://github.com/taylornetwork
[link-laravel-doc]: https://laravel.com/docs/5.3/eloquent