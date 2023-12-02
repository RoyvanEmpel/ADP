<?php

namespace UnitTests;

include(__DIR__ . '/../SelectionSort.php');

use PHPUnit\Framework\TestCase;

class SelectionSortTest extends TestCase
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

    // ASC - sorting
    public function testRandomArray()
    {
        $randomArray = [];
        for ($i = 0; $i < 100; $i++) { 
            $randomArray[] = rand(0, 10000);
        }

        $originalArray = $randomArray;
        $this->assertEquals($originalArray, $randomArray, 'Arrays should not be initially sorted.');
        $this->assertFalse($this->isSorted($randomArray), 'Validate that the array is not sorted');

        selectionSort($randomArray);

        $this->assertTrue($this->isSorted($randomArray), 'Array should be sorted after selection sort.');
    }

    public function testSortedArray()
    {
        $sortedArray = [];
        for ($i = 0; $i < 100; $i++) { 
            $sortedArray[] = $i;
        }

        $originalArray = $sortedArray;
        $this->assertEquals($originalArray, $sortedArray, 'Arrays should be initially sorted.');
        $this->assertTrue($this->isSorted($sortedArray), 'Validate that the array is sorted');

        selectionSort($sortedArray);

        $this->assertTrue($this->isSorted($sortedArray), 'Array should be sorted after selection sort.');
        $this->assertEquals($originalArray, $sortedArray, 'Check if after the method the array is still sorted.');
    }

    public function testDescArray()
    {
        $sortedArray = [];
        for ($i = 100; $i >= 0; $i--) { 
            $sortedArray[] = $i;
        }
        
        $originalArray = $sortedArray;
        $this->assertEquals($originalArray, $sortedArray, 'Arrays should be initially sorted.');
        $this->assertFalse($this->isSorted($sortedArray), 'Validate that the array is sorted');

        selectionSort($sortedArray);

        $this->assertTrue($this->isSorted($sortedArray), 'Array should be sorted after selection sort.');
    }

    public function testSingleNumberArray()
    {
        $singleNumArray = [];
        for ($i = 0; $i < 100; $i++) { 
            $singleNumArray[] = 2;
        }

        $originalArray = $singleNumArray;
        $this->assertEquals($originalArray, $singleNumArray, 'Array should be sorted, but this is for the insertion to check');
        $this->assertTrue($this->isSorted($singleNumArray), 'Array should be sorted');

        selectionSort($singleNumArray);

        $this->assertTrue($this->isSorted($singleNumArray), 'Array should be sorted after selection sort.');
        $this->assertEquals($originalArray, $singleNumArray, 'Check if after the method the array is still the same as before.');
    }


    // Desc sorting
    public function testRandomArrayDesc()
    {
        $randomArray = [];
        for ($i = 0; $i < 100; $i++) { 
            $randomArray[] = rand(0, 10000);
        }

        $originalArray = $randomArray;
        $this->assertEquals($originalArray, $randomArray, 'Arrays should not be initially sorted.');
        $this->assertFalse($this->isSorted($randomArray, 'desc'), 'Validate that the array is not sorted');

        selectionSort($randomArray, 'desc');

        $this->assertTrue($this->isSorted($randomArray, 'desc'), 'Array should be sorted after selection sort.');
    }

    public function testSortedArrayDesc()
    {
        $sortedArray = [];
        for ($i = 0; $i < 100; $i++) { 
            $sortedArray[] = $i;
        }

        $originalArray = $sortedArray;
        $this->assertEquals($originalArray, $sortedArray, 'Arrays should be initially sorted.');
        $this->assertFalse($this->isSorted($sortedArray, 'desc'), 'Validate that the array is sorted');

        selectionSort($sortedArray, 'desc');

        $this->assertTrue($this->isSorted($sortedArray, 'desc'), 'Array should be sorted after selection sort.');
    }

    public function testDescArrayDesc()
    {
        $sortedArray = [];
        for ($i = 100; $i >= 0; $i--) { 
            $sortedArray[] = $i;
        }
        
        $originalArray = $sortedArray;
        $this->assertEquals($originalArray, $sortedArray, 'Arrays should be initially sorted.');
        $this->assertTrue($this->isSorted($sortedArray, 'desc'), 'Validate that the array is sorted');

        selectionSort($sortedArray, 'desc');

        $this->assertTrue($this->isSorted($sortedArray, 'desc'), 'Array should be sorted after selection sort.');
    }

    public function testSingleNumberArrayDesc()
    {
        $singleNumArray = [];
        for ($i = 0; $i < 100; $i++) { 
            $singleNumArray[] = 2;
        }

        $originalArray = $singleNumArray;
        $this->assertEquals($originalArray, $singleNumArray, 'Array should be sorted, but this is for the insertion to check');
        $this->assertTrue($this->isSorted($singleNumArray, 'desc'), 'Array should be sorted');

        selectionSort($singleNumArray, 'desc');

        $this->assertTrue($this->isSorted($singleNumArray, 'desc'), 'Array should be sorted after selection sort.');
        $this->assertEquals($originalArray, $singleNumArray, 'Check if after the method the array is still the same as before.');
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

                selectionSort($array);
                
                $this->assertTrue($this->isSorted($array), 'Check if its sorted after the selectionSort. This should always be true');
            }

            // DESC - sorting
            foreach ($jsonContents as $testData) {
                $array = [];
                foreach ($testData as $value) {
                    $array[] = $value;
                }

                selectionSort($array, 'desc');
                
                $this->assertTrue($this->isSorted($array, 'desc'), 'Check if its sorted after the selectionSort. This should always be true');
            }
        }
    }
}