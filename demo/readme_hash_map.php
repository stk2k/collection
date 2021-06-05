<?php
require_once dirname(__DIR__). '/vendor/autoload.php';

use stk2k\collection\HashMap;

$data = ['name' => 'David', 'age' => 21, 'height' => 172.2];

echo 'iterate:' . PHP_EOL;
$output = [];
foreach(new HashMap($data) as $item){
    $output[] = $item;
}
echo ' ' . implode(',', $output) . PHP_EOL;     // David,21,172.2

echo 'join:' . PHP_EOL;
echo ' ' . (new HashMap($data))->join() . PHP_EOL;    // David,21,172.2
