<?php
require_once __DIR__. '/include/autoload.php';

use Stk2k\Collection\Vector;

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
