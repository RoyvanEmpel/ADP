<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/dynamic-array/DynamicArray.php');

use Cases\DynamicArray;

$testingSize = 50000;
$list = new DynamicArray();

echo "Testing DynamicArray - add\n";
Benchmark::start('DynamicArray - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->add("waarde" . $i);
}
Benchmark::end('DynamicArray - add');

echo "Testing DynamicArray - get\n";
Benchmark::start('DynamicArray - get');
for ($i = 0; $i < $testingSize; $i++) {
  $list->get($i);
}
Benchmark::end('DynamicArray - get');

echo "Testing DynamicArray - find\n";
Benchmark::start('DynamicArray - find');
for ($i = 0; $i < $testingSize; $i++) {
  $list->find("waarde" . $i);
}
Benchmark::end('DynamicArray - find');

echo "Testing DynamicArray - contains\n";
Benchmark::start('DynamicArray - contains');
for ($i = 0; $i < $testingSize; $i++) {
  $list->contains("waarde" . $i);
}
Benchmark::end('DynamicArray - contains');

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
