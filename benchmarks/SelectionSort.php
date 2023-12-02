<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/selection-sort/SelectionSort.php');

use Cases\SelectionSort;

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

echo "Testing SelectionSort - Random asc\n";
$tmp = $testRandom;
Benchmark::start('SelectionSort - Random asc');
selectionSort($tmp);
Benchmark::end('SelectionSort - Random asc');

echo "Testing SelectionSort - Random desc\n";
$tmp = $testRandom;
Benchmark::start('SelectionSort - Random desc');
selectionSort($tmp, 'desc');
Benchmark::end('SelectionSort - Random desc');

echo "Testing SelectionSort - Sort already sorted\n";
$tmp = $testSortedAsc;
Benchmark::start('SelectionSort - Sort already sorted');
selectionSort($tmp);
Benchmark::end('SelectionSort - Sort already sorted');

echo "Testing SelectionSort - Sorted to desc\n";
$tmp = $testSortedAsc;
Benchmark::start('SelectionSort - Sorted to desc');
selectionSort($tmp, 'desc');
Benchmark::end('SelectionSort - Sorted to desc');

echo "Testing SelectionSort - Desc sort already sorted\n";
$tmp = $testSortedDesc;
Benchmark::start('SelectionSort - Desc sort already sorted');
selectionSort($tmp, 'desc');
Benchmark::end('SelectionSort - Desc sort already sorted');

echo "Testing SelectionSort - Desc sort to asc\n";
$tmp = $testSortedDesc;
Benchmark::start('SelectionSort - Desc sort to asc');
selectionSort($tmp);
Benchmark::end('SelectionSort - Desc sort to asc');


print_r(Benchmark::getAll());
