<?php

use Cases\DynamicArray;

function binarySearch(DynamicArray $array, int $search): int|bool
{
    if ($array->getSize() === 0) { return false; }

    $left = 0;
    $right = $array->getSize() - 1;
    
    while ($left <= $right) {
        $middle = floor(($left + $right) / 2);

        if ($array->get($middle) < $search) {
            $left = $middle + 1;
        } else if ($array->get($middle) > $search) {
            $right = $middle - 1;
        } else {
            return $array->get($middle);
        }
    }

    return false;
}

function isSorted(mixed $array)
{
    $length = count($array);
    $checkValues = ['integer', 'float'];

    $ascending = true;

    for ($i = 0; $i < $length; $i++) {
        if (!in_array(gettype($array[$i]), $checkValues)) {
            return false;
        }

        if (isset($array[$i - 1]) && $array[$i] < $array[$i - 1]) {
            $ascending = false;
        }
    }

    return $ascending;
}