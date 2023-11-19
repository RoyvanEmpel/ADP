<?php

use Cases\DynamicArray;

function binarySearch(DynamicArray $array, int $search): int|bool
{
    if ($array->getSize() === 0) { return false; }

    $left = 0;
    $right = $array->getSize() - 1;
    
    while ($left <= $right) {
        $middle = floor(($left + $right) / 2);

        $middleData = $array->get($middle);

        if ($middleData < $search) {
            $left = $middle + 1;
        } else if ($middleData > $search) {
            $right = $middle - 1;
        } else {
            return $middleData;
        }
    }

    return false;
}

function isSorted(mixed $array)
{
    $length = count($array);

    for ($i = 0; $i < $length; $i++) {
        if (!is_numeric($array[$i])) {
            return false;
        }

        if (isset($array[$i - 1]) && $array[$i] < $array[$i - 1]) {
            return false;
        }
    }

    return true;
}