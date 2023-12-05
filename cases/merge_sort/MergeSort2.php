<?php

function mergeSort(array &$array) {
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

function merge(array &$array, array $left, array $right) {
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
