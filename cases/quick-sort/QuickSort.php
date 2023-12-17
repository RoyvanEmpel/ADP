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
        $pivotIndex = self::getPivot($low, $high);
        $pivot = $array[$pivotIndex];
        self::swap($array, $pivotIndex, $high);

        $i = $low;

        for ($j = $low; $j < $high; $j++) {
            if (($order == 'asc' && $array[$j] < $pivot) || ($order == 'desc' && $array[$j] > $pivot)) {
                self::swap($array, $i, $j);
                $i++;
            }
        }

        self::swap($array, $i, $high);
        return $i;
    }

    private static function swap(array &$array, int $i, int $j)
    {
        $temp = $array[$i];
        $array[$i] = $array[$j];
        $array[$j] = $temp;
    }

    private static function getPivot(int $low, int $high)
    {
        return $low + (int)(($high - $low) / 2);
    }
}