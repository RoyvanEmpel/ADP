<?php
use function Cases\testMergeSort;

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/merge-sort/MergeSort.php');
include(__DIR__ . '/../cases/merge-sort/MergeSort2.php');

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

echo "Testing MergeSort - Random asc\n";
$tmp = $testRandom;
Benchmark::start('MergeSort - Random asc');
testMergeSort($tmp);
Benchmark::end('MergeSort - Random asc');

echo "Testing MergeSort - Sort already sorted\n";
$tmp = $testSortedAsc;
Benchmark::start('MergeSort - Sort already sorted');
testMergeSort($tmp);
Benchmark::end('MergeSort - Sort already sorted');

echo "Testing MergeSort - Desc sort to asc\n";
$tmp = $testSortedDesc;
Benchmark::start('MergeSort - Desc sort to asc');
testMergeSort($tmp);
Benchmark::end('MergeSort - Desc sort to asc');

echo "Testing MergeSort2 - Random asc\n";
$tmp = $testRandom;
Benchmark::start('MergeSort2 - Random asc');
mergeSort($tmp);
Benchmark::end('MergeSort2 - Random asc');

echo "Testing MergeSort - Sort already sorted\n";
$tmp = $testSortedAsc;
Benchmark::start('MergeSort2 - Sort already sorted');
mergeSort($tmp);
Benchmark::end('MergeSort2 - Sort already sorted');

echo "Testing MergeSort - Desc sort to asc\n";
$tmp = $testSortedDesc;
Benchmark::start('MergeSort2 - Desc sort to asc');
mergeSort($tmp);
Benchmark::end('MergeSort2 - Desc sort to asc');


print_r(Benchmark::getAll());
