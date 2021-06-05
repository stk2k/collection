<?php
require_once dirname(__DIR__). '/vendor/autoload.php';

use stk2k\collection\Set;

$data = ['red', 'green', 'blue'];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new Set($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // red,green,blue

echo 'join:' . PHP_EOL;
echo ' ' . (new Set($data))->join() . PHP_EOL;    // red,green,blue
