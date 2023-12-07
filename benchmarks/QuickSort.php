<?php

use Cases\QuickSort;

use function Cases\testQuickSort;

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/quick-sort/QuickSort.php');

$testingSize = 10000;

$testRandom = [];
for ($i = 0; $i < $testingSize; $i++) {
    $testRandom[] = rand(0, 10000);
}

$testSortedAsc = [];
for ($i = 0; $i < $testingSize; $i++) {
    $testSortedAsc[] = $i;
}

$testSortedDesc = [];
for ($i = $testingSize; $i > 0; $i--) {
    $testSortedDesc[] = $i;
}

echo "Testing QuickSort - Random asc\n";
$tmp = $testRandom;
Benchmark::start('QuickSort - Random asc');
QuickSort::quickSort($tmp, 0, count($tmp) - 1);
Benchmark::end('QuickSort - Random asc');

echo "Testing QuickSort - Sort already sorted\n";
$tmp = $testSortedAsc;
Benchmark::start('QuickSort - Sort already sorted');
QuickSort::quickSort($tmp, 0, count($tmp) - 1);
Benchmark::end('QuickSort - Sort already sorted');

echo "Testing QuickSort - Desc sort to asc\n";
$tmp = $testSortedDesc;
Benchmark::start('QuickSort - Desc sort to asc');
QuickSort::quickSort($tmp, 0, count($tmp) - 1);
Benchmark::end('QuickSort - Desc sort to asc');


print_r(Benchmark::getAll());
