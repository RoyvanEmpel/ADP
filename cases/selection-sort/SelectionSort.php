<?php

function selectionSort(array &$array, $order = 'ASC')
{
    $arrayLength = count($array);

    for ($i = 0; $i < $arrayLength - 1; $i++) { 
        $orderIndex = $i;

        for ($j = ($i + 1); $j < $arrayLength; $j++) { 
            if (strtolower($order) == 'asc' && $array[$j] < $array[$orderIndex]) {
                $orderIndex = $j;
            } else if (strtolower($order) == 'desc' && $array[$j] > $array[$orderIndex]) {
                $orderIndex = $j;
            }
        }

        $currentValue = $array[$orderIndex];
        $array[$orderIndex] = $array[$i];
        $array[$i] = $currentValue;
    }
}