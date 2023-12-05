<?php

function insertionSort(array &$array, string $order = "asc")
{
    for ($i = 1; $i < count($array); $i++) {
        $toBeInserted = $array[$i];

        $j = $i;
        if (strtolower($order) == "asc") {
            while ($j > 0 && $toBeInserted < $array[$j - 1]) {
                $array[$j] = $array[$j - 1];
                $j--;
            }
        } elseif (strtolower($order) == "desc") {
            while ($j > 0 && $toBeInserted > $array[$j - 1]) {
                $array[$j] = $array[$j - 1];
                $j--;
            }
        }
        
        $array[$j] = $toBeInserted;
    }

    return $array;
}
