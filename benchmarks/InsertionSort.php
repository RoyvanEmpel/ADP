<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/insertion-sort/InsertionSort.php');

use Cases\InsertionSort;

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

echo "Testing InsertionSort - Random asc\n";
$tmp = $testRandom;
Benchmark::start('InsertionSort - Random asc');
insertionSort($tmp);
Benchmark::end('InsertionSort - Random asc');

echo "Testing InsertionSort - Random desc\n";
$tmp = $testRandom;
Benchmark::start('InsertionSort - Random desc');
insertionSort($tmp, 'desc');
Benchmark::end('InsertionSort - Random desc');

echo "Testing InsertionSort - Sort already sorted\n";
$tmp = $testSortedAsc;
Benchmark::start('InsertionSort - Sort already sorted');
insertionSort($tmp);
Benchmark::end('InsertionSort - Sort already sorted');

echo "Testing InsertionSort - Sorted to desc\n";
$tmp = $testSortedAsc;
Benchmark::start('InsertionSort - Sorted to desc');
insertionSort($tmp, 'desc');
Benchmark::end('InsertionSort - Sorted to desc');

echo "Testing InsertionSort - Desc sort already sorted\n";
$tmp = $testSortedDesc;
Benchmark::start('InsertionSort - Desc sort already sorted');
insertionSort($tmp, 'desc');
Benchmark::end('InsertionSort - Desc sort already sorted');

echo "Testing InsertionSort - Desc sort to asc\n";
$tmp = $testSortedDesc;
Benchmark::start('InsertionSort - Desc sort to asc');
insertionSort($tmp);
Benchmark::end('InsertionSort - Desc sort to asc');

print_r(Benchmark::getAll());
