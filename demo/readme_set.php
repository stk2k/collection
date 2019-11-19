<?php
require_once __DIR__. '/include/autoload.php';

use Stk2k\Collection\Set;

$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new Set($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new Set($data))->join() . PHP_EOL;    // red,green,blue
