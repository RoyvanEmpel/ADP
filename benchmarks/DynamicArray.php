<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/dynamic-array/DynamicArray.php');

use Cases\DynamicArray;

$testingSize = 1000000;
$list = new DynamicArray();

echo "Testing DynamicArray - add\n";
Benchmark::start('DynamicArray - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->add($i);
}
Benchmark::end('DynamicArray - add');

echo "Testing DynamicArray - get\n";
Benchmark::start('DynamicArray - get');
for ($i = 0; $i < $testingSize; $i++) {
  $list->get($i);
}
Benchmark::end('DynamicArray - get');

$memoryUsage = Benchmark::memory();

echo "Testing DynamicArray - remove end to start\n";
Benchmark::start('DynamicArray - remove end to start');
for ($i = 0; $i < $testingSize; $i++) {
  $list->remove(($testingSize - $i) - 1);
}
Benchmark::end('DynamicArray - remove end to start');

// refill array
for ($i = 0; $i < $testingSize; $i++) {
  $list->add($i);
}

echo "Testing DynamicArray - remove start to end\n";
Benchmark::start('DynamicArray - remove start to end');
for ($i = 0; $i < $testingSize; $i++) {
  $list->remove($list->getSize() - 1);
}
Benchmark::end('DynamicArray - remove start to end');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
