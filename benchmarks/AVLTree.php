<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/avltree/AVLTree.php');

use Cases\AVLTree;

$testingSize = 10000;
$testData = [];

for ($i = 0; $i < $testingSize; $i++) {
    $testData[] = $i;
}

$tree = new AVLTree();

echo "Testing AVLTree - add\n";
Benchmark::start('AVLTree - add');
foreach ($testData as $i) {
    $tree->insert($i);
}
Benchmark::end('AVLTree - add');

echo "Testing AVLTree - search\n";
Benchmark::start('AVLTree - search');
foreach ($testData as $i) {
    $tree->search($i);
}
Benchmark::end('AVLTree - search');

$memoryUsage = Benchmark::memory();

echo "Testing AVLTree - delete\n";
Benchmark::start('AVLTree - delete');
foreach ($testData as $i) {
    $tree->delete($i);
}
Benchmark::end('AVLTree - delete');


$tree = new AVLTree();

shuffle($testData);

echo "Testing AVLTree - add random\n";
Benchmark::start('AVLTree - add random');
foreach ($testData as $i) {
    $tree->insert($i);
}
Benchmark::end('AVLTree - add random');

shuffle($testData);

echo "Testing AVLTree - search random\n";
Benchmark::start('AVLTree - search random');
foreach ($testData as $i) {
    $tree->search($i);
}
Benchmark::end('AVLTree - search random');

$memoryUsage = Benchmark::memory();

shuffle($testData);

echo "Testing AVLTree - delete random\n";
Benchmark::start('AVLTree - delete random');
foreach ($testData as $i) {
    $tree->delete($i);
}
Benchmark::end('AVLTree - delete random');



echo PHP_EOL;
echo PHP_EOL;
print_r($memoryUsage);
echo PHP_EOL;
print_r(Benchmark::getAll());
echo PHP_EOL;
echo PHP_EOL;
die;

