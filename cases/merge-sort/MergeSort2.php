<?php

include(__DIR__ . '/../../benchmarks/Benchmark.php');

function mergeSort(&$array) {
    $arraySize = count($array);
    if ($arraySize < 2) {
        return;
    }
    $mid = (int) ($arraySize / 2);
    $left = array_slice($array, 0, $mid);
    $right = array_slice($array, $mid);

    mergeSort($left);
    mergeSort($right);

    merge($array, $left, $right);
}

function merge(&$array, $left, $right) {
    $i = 0; $j = 0; $k = 0;
    $leftSize = count($left);
    $rightSize = count($right);

    while ($i < $leftSize && $j < $rightSize) {
        if ($left[$i] <= $right[$j]) {
            $array[$k] = $left[$i];
            $i++;
        } else {
            $array[$k] = $right[$j];
            $j++;
        }
        $k++;
    }

    while ($i < $leftSize) {
        $array[$k] = $left[$i];
        $i++; $k++;
    }

    while ($j < $rightSize) {
        $array[$k] = $right[$j];
        $j++; $k++;
    }
}

Benchmark::start('mergeSort');
$inputArray = [8, 6, 0, 7, 5, 3, 1];
for ($i=1000000; $i > 0; $i--) { 
    $inputArray[] = $i;
}

mergeSort($inputArray);
Benchmark::end('mergeSort');

print_r(Benchmark::getAll());

?>
