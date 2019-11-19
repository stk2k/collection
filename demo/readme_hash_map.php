<?php
require_once __DIR__. '/include/autoload.php';

use Stk2k\Collection\HashMap;

$data = ['name' => 'David', 'age' => 21, 'height' => 172.2];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new HashMap($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // David,21,172.2

echo 'join:' . PHP_EOL;
echo ' ' . (new HashMap($data))->join() . PHP_EOL;    // David,21,172.2
