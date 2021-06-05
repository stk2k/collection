<?php
require_once dirname(__DIR__). '/vendor/autoload.php';

use stk2k\collection\Stack;

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
