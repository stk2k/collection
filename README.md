Simple PHP collection class library
=======================

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stk2k/collection.svg?style=flat-square)](https://packagist.org/packages/stk2k/collection)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/stk2k/collection.svg?branch=master)](https://travis-ci.org/stk2k/collection)
[![Coverage Status](https://coveralls.io/repos/github/stk2k/collection/badge.svg?branch=master)](https://coveralls.io/github/stk2k/collection?branch=master)
[![Code Climate](https://codeclimate.com/github/stk2k/collection/badges/gpa.svg)](https://codeclimate.com/github/stk2k/collection)
[![Total Downloads](https://img.shields.io/packagist/dt/stk2k/collection.svg?style=flat-square)](https://packagist.org/packages/stk2k/collection)

## Description

Simple PHP collection class library

## Feature

- Sortable(ArrayList/Queue/Stack/Vector)

## Supported Data Structure

- ArrayList
- Collection
- Property(supports hierarchical access to array for string/int/float/bool values)
- Queue
- Set
- Stack
- Vector

## Demo

### Collection

```php
$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new Collection($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new Collection($data))->join() . PHP_EOL;    // red,green,blue

echo 'replace:' . PHP_EOL;
echo ' ' . (new Collection($data))->replace('green', 'yellow')->join() . PHP_EOL;     // red,yellow,blue

echo 'each:' . PHP_EOL;
(new Collection($data))->each(function($item){
    echo "[$item],"; 
});    // [red],[green],[blue],

echo 'map:' . PHP_EOL;
echo ' ' . (new Collection($data))->map(function($item){
    return "[$item]"; 
})->join() . PHP_EOL;      // [red],[green],[blue]

echo 'reduce:' . PHP_EOL;
echo ' ' . (new Collection($data))->reduce(function($tmp,$item){
    return $tmp + strlen($item);
}) . PHP_EOL;     // 12

```

### ArrayList

```php
$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new ArrayList($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->join() . PHP_EOL;    // red,green,blue

echo 'first:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->first() . PHP_EOL;    // red

echo 'last:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->last() . PHP_EOL;    // blue

echo 'reverse:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->reverse()->join() . PHP_EOL;      // blue,green,red

echo 'replace then reverse:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->replace('green', 'yellow')->reverse()->join() . PHP_EOL;      // blue,yellow,red

echo 'shift:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->shift($item)->join() . PHP_EOL;       // green,blue

echo 'unshift:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->unshift('yellow')->join() . PHP_EOL;       // yellow,red,green,blue

echo 'push:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->push('yellow')->join() . PHP_EOL;       // red,green,blue,yellow

echo 'pop:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->pop($item)->join() . PHP_EOL;       // red,green

echo 'sort:' . PHP_EOL;
echo ' ' . (new ArrayList($data))->sort()->join() . PHP_EOL;       // blue,green,red

```

### Vector

```php
$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new Vector($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new Vector($data))->join() . PHP_EOL;    // red,green,blue

echo 'first:' . PHP_EOL;
echo ' ' . (new Vector($data))->first() . PHP_EOL;    // red

echo 'last:' . PHP_EOL;
echo ' ' . (new Vector($data))->last() . PHP_EOL;    // blue

echo 'reverse:' . PHP_EOL;
echo ' ' . (new Vector($data))->reverse()->join() . PHP_EOL;      // blue,green,red

echo 'replace then reverse:' . PHP_EOL;
echo ' ' . (new Vector($data))->replace('green', 'yellow')->reverse()->join() . PHP_EOL;      // blue,yellow,red

echo 'shift:' . PHP_EOL;
echo ' ' . (new Vector($data))->shift($item)->join() . PHP_EOL;       // green,blue

echo 'unshift:' . PHP_EOL;
echo ' ' . (new Vector($data))->unshift('yellow')->join() . PHP_EOL;       // yellow,red,green,blue

echo 'push:' . PHP_EOL;
echo ' ' . (new Vector($data))->push('yellow')->join() . PHP_EOL;       // red,green,blue,yellow

echo 'pop:' . PHP_EOL;
echo ' ' . (new Vector($data))->pop($item)->join() . PHP_EOL;       // red,green

echo 'sort:' . PHP_EOL;
echo ' ' . (new Vector($data))->sort()->join() . PHP_EOL;       // blue,green,red

```

### Stack

```php
$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new Stack($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new Stack($data))->join() . PHP_EOL;    // red,green,blue

echo 'peek:' . PHP_EOL;
echo ' ' . (new Stack($data))->peek() . PHP_EOL;    // red

echo 'reverse:' . PHP_EOL;
echo ' ' . (new Stack($data))->reverse()->join() . PHP_EOL;      // blue,green,red

echo 'replace then reverse:' . PHP_EOL;
echo ' ' . (new Stack($data))->replace('green', 'yellow')->reverse()->join() . PHP_EOL;      // blue,yellow,red

echo 'push:' . PHP_EOL;
echo ' ' . (new Stack($data))->push('yellow')->join() . PHP_EOL;       // red,green,blue,yellow

echo 'pop:' . PHP_EOL;
echo ' ' . (new Stack($data))->pop($item)->join() . PHP_EOL;       // red,green

echo 'sort:' . PHP_EOL;
echo ' ' . (new Stack($data))->sort()->join() . PHP_EOL;       // blue,green,red

```

### HashMap

```php
$data = ['name' => 'David', 'age' => 21, 'height' => 172.2];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new HashMap($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // David,21,172.2

echo 'join:' . PHP_EOL;
echo ' ' . (new HashMap($data))->join() . PHP_EOL;    // David,21,172.2

```

### Set

```php
$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new Set($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new Set($data))->join() . PHP_EOL;    // red,green,blue

```

## Requirement

PHP 7.1 or later

## Installing stk2k/collection

The recommended way to install stk2k/collection is through
[Composer](http://getcomposer.org).

```bash
composer require stk2k/collection
```

After installing, you need to require Composer's autoloader:

```php
require 'vendor/autoload.php';
```

## License
This library is licensed under the MIT license.

## Author

[stk2k](https://github.com/stk2k)

## Disclaimer

This software is no warranty.

We are not responsible for any results caused by the use of this software.

Please use the responsibility of the your self.


