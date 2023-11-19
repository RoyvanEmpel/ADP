<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/binary-search/BinarySearch.php');


$testingSize = 1000000;

$testData = [];
for ($i = 0; $i < $testingSize; $i++) { 
  $testData[] = $i;
}

echo "Testing BinarySearch - Add linear\n";
Benchmark::start('BinarySearch - Add linear');

for ($i = 0; $i < $testingSize; $i++) {
    binarySearch($array, $i);
}

Benchmark::end('BinarySearch - Add linear');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
