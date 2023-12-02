<?php

namespace UnitTests;

include(__DIR__ . '/../MergeSort.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\PriorityQueue;
use Pasta;
use PastaType;
use SauceType;

class PriorityQueueTest extends TestCase
{
    public function testMergeSort()
    {
        $inputArray = [4, 2, 6, 8, 1, 3, 5, 7];
        MergeSort::mergeSort($inputArray);
        $expectedArray = [1, 2, 3, 4, 5, 6, 7, 8];
        $this->assertEquals($expectedArray, $inputArray);
    }
    
    public function testMergeSortWithDuplicates()
    {
        $inputArray = [4, 2, 6, 8, 1, 3, 5, 7, 4, 8];
        MergeSort::mergeSort($inputArray);
        $expectedArray = [1, 2, 3, 4, 4, 5, 6, 7, 8, 8];
        $this->assertEquals($expectedArray, $inputArray);
    }
    
    public function testMergeSortWithEmptyArray()
    {
        $inputArray = [];
        MergeSort::mergeSort($inputArray);
        $expectedArray = [];
        $this->assertEquals($expectedArray, $inputArray);
    }
    
    public function testMergeSortWithArrayOfSizeOne()
    {
        $inputArray = [5];
        MergeSort::mergeSort($inputArray);
        $expectedArray = [5];
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

                MergeSort::mergeSort($array);
                
                $this->assertTrue($this->isSorted($array), 'Check if its sorted after the selectionSort. This should always be true');
            }
        }
    }
}