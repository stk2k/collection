<?php
require_once __DIR__. '/include/autoload.php';

use Stk2k\Collection\Collection;

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

echo 'map:' . PHP_EOL;
echo ' ' . (new Collection($data))->map(function($item){ return "[$item]"; })->join() . PHP_EOL;      // [red],[green],[blue]

echo 'reduce:' . PHP_EOL;
echo ' ' . (new Collection($data))->reduce(function($tmp,$item){ return $tmp+strlen($item); }) . PHP_EOL;     // 12
