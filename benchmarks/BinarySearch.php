<?php

use Cases\DynamicArray;

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/dynamic-array/DynamicArray.php');
include(__DIR__ . '/../cases/binary-search/BinarySearch.php');

$testingSize = 50000;

$testData = new DynamicArray();
for ($i = 0; $i < $testingSize; $i++) { 
  $testData->add($i);
}

echo "Testing BinarySearch\n";
Benchmark::start('BinarySearch');

for ($i = 0; $i < $testingSize; $i++) {
    binarySearch($testData, $i);
}
$memoryUsage = Benchmark::memory();

Benchmark::end('BinarySearch');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
