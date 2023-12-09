<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/hashtable/Hashtable.php');

use Cases\Hashtable;

$testingSize = 50000;
$list = new Hashtable($testingSize);

echo "Testing Hashtable - add\n";
Benchmark::start('Hashtable - add');
for ($i = 0; $i < $testingSize; $i++) {
  $list->insert("$i", ['money' => 22 + $i]);
}
Benchmark::end('Hashtable - add');

echo "Testing Hashtable - get\n";
Benchmark::start('Hashtable - get');
for ($i = 0; $i < $testingSize; $i++) {
  $list->get("$i");
}
Benchmark::end('Hashtable - get');

echo "Testing Hashtable - update\n";
Benchmark::start('Hashtable - update');
for ($i = 0; $i < $testingSize; $i++) {
  $list->update("$i", ['money' => $testingSize - $i]);
}
Benchmark::end('Hashtable - update');

$memoryUsage = Benchmark::memory();

echo "Testing Hashtable - delete\n";
Benchmark::start('Hashtable - delete');
for ($i = 0; $i < $testingSize; $i++) {
  $list->delete("$i");
}
Benchmark::end('Hashtable - delete');

echo PHP_EOL;
echo PHP_EOL;
print_r($memoryUsage);
echo PHP_EOL;
print_r(Benchmark::getAll());
echo PHP_EOL;
echo PHP_EOL;
die;