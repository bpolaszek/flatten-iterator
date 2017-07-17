[![Latest Stable Version](https://poser.pugx.org/bentools/flatten-iterator/v/stable)](https://packagist.org/packages/bentools/flatten-iterator)
[![License](https://poser.pugx.org/bentools/flatten-iterator/license)](https://packagist.org/packages/bentools/flatten-iterator)
[![Build Status](https://img.shields.io/travis/bpolaszek/flatten-iterator/master.svg?style=flat-square)](https://travis-ci.org/bpolaszek/flatten-iterator)
[![Coverage Status](https://coveralls.io/repos/github/bpolaszek/flatten-iterator/badge.svg?branch=master)](https://coveralls.io/github/bpolaszek/flatten-iterator?branch=master)
[![Quality Score](https://img.shields.io/scrutinizer/g/bpolaszek/flatten-iterator.svg?style=flat-square)](https://scrutinizer-ci.com/g/bpolaszek/flatten-iterator)
[![Total Downloads](https://poser.pugx.org/bentools/flatten-iterator/downloads)](https://packagist.org/packages/bentools/flatten-iterator)

# FlattenIterator

Flattens arrays and / or traversables. Accepts any `iterable` composed of `iterables`.

PHP 7.1+

Usage
-------

```php
use BenTools\FlattenIterator\FlattenIterator;

require_once __DIR__ . '/vendor/autoload.php';

$cities = [
    [
        'london' => 'London',
        'paris' => 'Paris',
    ],
    new \ArrayIterator([
        'berlin' => 'Berlin',
        'bruxelles' => 'Bruxelles',
    ]),
    (function () {
        yield 'budapest' => 'Budapest';
        yield 'prague' => 'Prague';
    })(),
];

foreach (new FlattenIterator($cities) as $city) {
    var_dump($city);
}
```

Output:
```
string(6) "London"
string(5) "Paris"
string(6) "Berlin"
string(9) "Bruxelles"
string(8) "Budapest"
string(6) "Prague"
```


Array output and fluent interface
---------------------------------

You can use the built-in function to generate your flattened data, and export them as an array:

```php
use function BenTools\FlattenIterator\flatten;
print_r(flatten($cities)->asArray());
```

Output:
```php
array(6) {
  [0]=>
  string(6) "London"
  [1]=>
  string(5) "Paris"
  [2]=>
  string(6) "Berlin"
  [3]=>
  string(9) "Bruxelles"
  [4]=>
  string(8) "Budapest"
  [5]=>
  string(6) "Prague"
}
```

Preserve Keys
-------------
Set `$preserveKeys` to `true` to preserve keys in your flattened data:

```php
var_dump(flatten($cities, $preserveKeys = true)->asArray());
```

Output:
```
array(6) {
  ["london"]=>
  string(6) "London"
  ["paris"]=>
  string(5) "Paris"
  ["berlin"]=>
  string(6) "Berlin"
  ["bruxelles"]=>
  string(9) "Bruxelles"
  ["budapest"]=>
  string(8) "Budapest"
  ["prague"]=>
  string(6) "Prague"
}

```

Installation
------------

```
composer require bentools/flatten-iterator
```

Unit tests
----------
```
./vendor/bin/phpunit
```

See also
--------

[bentools/cartesian-product](https://github.com/bpolaszek/cartesian-product)

[bentools/string-combinations](https://github.com/bpolaszek/string-combinations)

[bentools/iterable-functions](https://github.com/bpolaszek/php-iterable-functions)
