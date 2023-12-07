<?php

namespace UnitTests;

include(__DIR__ . '/../QuickSort.php');

use PHPUnit\Framework\TestCase;
use Cases\QuickSort;

class QuickSortTest extends TestCase
{
    private function isSorted(array $array, $order = 'asc'): bool
    {
        $length = count($array);

        for ($i = 0; $i < $length - 1; $i++) {
            if (strtolower($order) == 'asc' && $array[$i] > $array[$i + 1]) {
                return false;
            } else if (strtolower($order) == 'desc' && $array[$i] < $array[$i + 1]) {
                return false;
            }
        }

        return true;
    }

    public function testQuickSort()
    {
        $inputArray = [4, 2, 6, 8, 1, 3, 5, 7];
        QuickSort::quickSort($inputArray, 0, count($inputArray) - 1);
        $expectedArray = [1, 2, 3, 4, 5, 6, 7, 8];
        $this->assertEquals($expectedArray, $inputArray);
    }

    public function testQuickSortWithDuplicates()
    {
        $inputArray = [4, 2, 6, 8, 1, 3, 5, 7, 4, 8];
        QuickSort::quickSort($inputArray, 0, count($inputArray) - 1);
        $expectedArray = [1, 2, 3, 4, 4, 5, 6, 7, 8, 8];
        $this->assertEquals($expectedArray, $inputArray);
    }

    public function testQuickSortWithEmptyArray()
    {
        $inputArray = [];
        QuickSort::quickSort($inputArray, 0, count($inputArray) - 1);
        $expectedArray = [];
        $this->assertEquals($expectedArray, $inputArray);
    }

    public function testQuickSortWithArrayOfSizeOne()
    {
        $inputArray = [5];
        QuickSort::quickSort($inputArray, 0, count($inputArray) - 1);
        $expectedArray = [5];
        $this->assertEquals($expectedArray, $inputArray);
    }

    public function testQuickSortDesc()
    {
        $inputArray = [4, 2, 6, 8, 1, 3, 5, 7];
        QuickSort::quickSort($inputArray, 0, count($inputArray) - 1, 'desc');
        $expectedArray = [8, 7, 6, 5, 4, 3, 2, 1];
        $this->assertEquals($expectedArray, $inputArray);
    }

    // JSON files
    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            // ASC - sorting
            foreach ($jsonContents as $testData) {
                $array = [];
                foreach ($testData as $value) {
                    $array[] = $value;
                }

                if (count($array) !== count(array_filter($array, 'is_numeric'))) {
                    continue;
                }

                QuickSort::quickSort($array, 0, count($array) - 1);
                
                $this->assertTrue($this->isSorted($array), 'Check if its sorted after the selectionSort. This should always be true');
            }

            // DESC - sorting
            foreach ($jsonContents as $testData) {
                $array = [];
                foreach ($testData as $value) {
                    $array[] = $value;
                }

                if (count($array) !== count(array_filter($array, 'is_numeric'))) {
                    continue;
                }

                QuickSort::quickSort($array, 0, count($array) - 1, 'desc');
                
                $this->assertTrue($this->isSorted($array, 'desc'), 'Check if its sorted after the selectionSort. This should always be true');
            }
        }
    }
}