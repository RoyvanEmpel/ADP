<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/stack/Stack.php');

use Cases\Stack;

$testingSize = 1000000;
$list = new Stack();

echo "Testing Stack - add\n";
Benchmark::start('Stack - add');

for ($i=0; $i < $testingSize; $i++) {
  $list->push($i);
}

Benchmark::end('Stack - add');

echo "Testing Stack - get\n";
Benchmark::start('Stack - get');

for ($i=0; $i < $testingSize; $i++) {
  $list->top();
}

Benchmark::end('Stack - get');

$memoryUsage = Benchmark::memory();

echo "Testing Stack - remove\n";
Benchmark::start('Stack - remove');

for ($i=0; $i < $testingSize; $i++) {
  $list->pop(($testingSize-$i) - 1);
}

Benchmark::end('Stack - remove');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";