<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/deque/Deque.php');

use Cases\Deque;

$testingSize = 50000;
$list = new Deque();

echo "Testing Deque - add\n";
Benchmark::start('Deque - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->insertLeft('waarde' . $i);
}
Benchmark::end('Deque - add');

echo "Testing Deque - add\n";
Benchmark::start('Deque - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->insertRight('waarde' . $i);
}
Benchmark::end('Deque - add');

$memoryUsage = Benchmark::memory();

echo "Testing Deque - remove ->deleteLeft()\n";
Benchmark::start('Deque - remove ->deleteLeft()');
for ($i = 0; $i < $testingSize; $i++) {
  $list->deleteLeft();
}
Benchmark::end('Deque - remove ->deleteLeft()');

echo "Testing Deque - remove ->deleteRight()\n";
Benchmark::start('Deque - remove ->deleteRight()');
for ($i = 0; $i < $testingSize; $i++) {
  $list->deleteRight();
}
Benchmark::end('Deque - remove ->deleteRight()');

print_r(Benchmark::getAll());
echo "\nMemory used: " . $memoryUsage . "\n\n";
