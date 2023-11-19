<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/priority-queue/PriorityQueue.php');

use Cases\PriorityQueue;

$testingSize = 1000000;
$queue = new PriorityQueue();

$testRandomPrio = [];
for ($i = 0; $i < $testingSize; $i++) { 
    $testRandomPrio[] = rand(0, 10000);
}

echo "Testing PriorityQueue - Add linear\n";
Benchmark::start('PriorityQueue - Add linear');

// Add linear
for ($i = 0; $i < $testingSize; $i++) {
    $queue->add($i, $i);
}

Benchmark::end('PriorityQueue - Add linear');


echo "Testing PriorityQueue - Add random\n";
Benchmark::start('PriorityQueue - Add random');

// Add random
for ($i = 0; $i < $testingSize; $i++) {
    $queue->add($i, $testRandomPrio[$i]);
}

Benchmark::end('PriorityQueue - Add random');


echo "Testing PriorityQueue - peek\n";
Benchmark::start('PriorityQueue - peek');

for ($i = 0; $i < $testingSize; $i++) {
  $queue->peek();
}

Benchmark::end('PriorityQueue - peek');

$memoryUsage = Benchmark::memory();

echo "Testing PriorityQueue - deleteMin\n";
Benchmark::start('PriorityQueue - deleteMin');

for ($i = 0; $i < $testingSize; $i++) {
  $queue->deleteMin();
}

Benchmark::end('PriorityQueue - deleteMin');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
