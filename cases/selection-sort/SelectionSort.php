<?php


function selectionSort(array &$array)
{
    $arrayLength = count($array);

    for ($i = 0; $i < $arrayLength - 1; $i++) { 
        $minIndex = $i;

        for ($j = ($i + 1); $j < $arrayLength; $j++) { 
            if ($array[$j] < $array[$minIndex]) {
                $minIndex = $j;
            }
        }

        $currentValue = $array[$minIndex];
        $array[$minIndex] = $array[$i];
        $array[$i] = $currentValue;
    }
}