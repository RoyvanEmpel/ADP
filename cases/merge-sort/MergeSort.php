<?php

namespace Cases;

class MergeSort
{
    public static function mergeSort(array &$array)
    {
        $tempArray = [];
        self::__mergeSort($array, $tempArray, 0, (count($array) - 1));
    }
    
    private static function __mergeSort(array &$array, array &$tempArray, int $left, int $right)
    {
        if ($left < $right) {
            $center = (int)(($left + $right) / 2);
            self::__mergeSort($array, $tempArray, $left, $center);
            self::__mergeSort($array, $tempArray, ($center + 1), $right);
            self::merge($array, $tempArray, $left, ($center + 1), $right);
        }
    }

    private static function merge(array &$array, array &$tempArray, int $left, int $center, int $right)
    {
        for ($i = $left; $i <= $right; $i++) {
            $tempArray[$i] = $array[$i];
        }

        $iterationLeft = $left;
        $iterationRight = $center;
        $current = $left;

        while ($iterationLeft < $center && $iterationRight <= $right) {
            if ($tempArray[$iterationLeft] <= $tempArray[$iterationRight]) {
                $array[$current] = $tempArray[$iterationLeft];
                $iterationLeft++;
            } else {
                $array[$current] = $tempArray[$iterationRight];
                $iterationRight++;
            }
            $current++;
        }

        while ($iterationLeft < $center) {
            $array[$current] = $tempArray[$iterationLeft];
            $iterationLeft++;
            $current++;
        }
    }
}

function testMergeSort(array $inputArray)
{
    echo "Original Array: " . implode(" ", $inputArray) . PHP_EOL;

    mergeSort::mergeSort($inputArray);

    echo "Sorted Array: " . implode(" ", $inputArray) . PHP_EOL;
}

// Test with the provided array
$inputArray = [8, 6, 0, 7, 5, 3, 1];
testMergeSort($inputArray);