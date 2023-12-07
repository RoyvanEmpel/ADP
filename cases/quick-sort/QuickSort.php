<?php

namespace Cases;

class QuickSort
{
    public static function quickSort(array &$array, int $low, int $high, $order = 'asc')
    {
        $order = strtolower($order);
        if ($low < $high) {
            $pivotIndex = self::partition($array, $low, $high, $order);
            self::quickSort($array, $low, $pivotIndex - 1, $order);
            self::quickSort($array, $pivotIndex + 1, $high, $order);
        }
    }

    private static function partition(array &$array, int $low, int $high, $order)
    {
        $pivot = self::getPivot($array, $low, $high);

        $i = $low - 1;

        for ($j = $low; $j < $high; $j++) {
            if (($order == 'asc' && $array[$j] <= $pivot) || ($order == 'desc' && $array[$j] >= $pivot)) {
                $i++;
                self::swap($array, $i, $j);
            }
        }

        self::swap($array, $i + 1, $high);
        return $i + 1;
    }

    private static function swap(array &$array, int $i, int $j)
    {
        $temp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $temp;
    }

    private static function getPivot(array &$array, int $low, int $high)
    {
        $mid = $low + (int)(($high - $low) / 2);
        $pivotIndices = [$low, $mid, $high];
        sort($pivotIndices);
        $pivotIndex = $pivotIndices[1];
        $pivot = $array[$pivotIndex];

        return $pivot;
    }
}