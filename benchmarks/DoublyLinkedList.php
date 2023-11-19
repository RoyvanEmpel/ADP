<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/doubly-linked-list/DoublyLinkedList.php');

use Cases\DoublyLinkedList;

$testingSize = 50000;
$list = new DoublyLinkedList();

echo "Testing DoublyLinkedList - add\n";
Benchmark::start('DoublyLinkedList - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->append('waarde' . $i);
}
Benchmark::end('DoublyLinkedList - add');

echo "Testing DoublyLinkedList - get\n";
Benchmark::start('DoublyLinkedList - get');
for ($i = 0; $i < $testingSize; $i++) {
  $list->find('waarde' . $i);
}
Benchmark::end('DoublyLinkedList - get');

$memoryUsage = Benchmark::memory();

echo "Testing DoublyLinkedList - remove ->pop()\n";
Benchmark::start('DoublyLinkedList - remove ->pop()');
for ($i = 0; $i < $testingSize; $i++) {
  $list->pop();
}
Benchmark::end('DoublyLinkedList - remove ->pop()');

// refill list
for ($i = 0; $i < $testingSize; $i++) {
  $list->append('waarde' . $i);
}

echo "Testing DoublyLinkedList - remove ->shift()\n";
Benchmark::start('DoublyLinkedList - remove ->shift()');
for ($i = 0; $i < $testingSize; $i++) {
  $list->shift();
}
Benchmark::end('DoublyLinkedList - remove ->shift()');

// refill list
for ($i = 0; $i < $testingSize; $i++) {
  $list->append('waarde' . $i);
}

echo "Testing DoublyLinkedList - remove through value - start to end\n";
Benchmark::start('DoublyLinkedList - remove through value - start to end');
for ($i = 0; $i < $testingSize; $i++) {
  $list->remove('waarde' . $i);
}
Benchmark::end('DoublyLinkedList - remove through value - start to end');

// refill list
for ($i = 0; $i < $testingSize; $i++) {
  $list->append('waarde' . $i);
}

echo "Testing DoublyLinkedList - remove through value - end to start\n";
Benchmark::start('DoublyLinkedList - remove through value - end to start');
for ($i = 0; $i < $testingSize; $i++) {
  $list->remove('waarde' . (($testingSize - 1)- $i));
}
Benchmark::end('DoublyLinkedList - remove through value - end to start');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
