<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/doubly-linked-list/DoublyLinkedList.php');

use Cases\DoublyLinkedList;

$testingSize = 10000;
$list = new DoublyLinkedList();

echo "Testing DoublyLinkedList - add\n";
Benchmark::start('DoublyLinkedList - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->append($i);
}
Benchmark::end('DoublyLinkedList - add');

echo "Testing DoublyLinkedList - get\n";
Benchmark::start('DoublyLinkedList - get');
for ($i = 0; $i < $testingSize; $i++) {
  $list->get($i);
}
Benchmark::end('DoublyLinkedList - get');

$memoryUsage = Benchmark::memory();

echo "Testing DoublyLinkedList - remove end to start\n";
Benchmark::start('DoublyLinkedList - remove end to start');
for ($i = 0; $i < $testingSize; $i++) {
  $list->remove(($testingSize - $i) - 1);
}
Benchmark::end('DoublyLinkedList - remove end to start');

// refill array
for ($i = 0; $i < $testingSize; $i++) {
  $list->append($i);
}

echo "Testing DoublyLinkedList - remove start to end\n";
Benchmark::start('DoublyLinkedList - remove start to end');
for ($i = 0; $i < $testingSize; $i++) {
  $list->remove($list->getSize() - 1);
}
Benchmark::end('DoublyLinkedList - remove start to end');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
