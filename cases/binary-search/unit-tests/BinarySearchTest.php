<?php

namespace UnitTests;

include(__DIR__ . '/../../dynamic-array/DynamicArray.php');
include(__DIR__ . '/../BinarySearch.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\DynamicArray;
use Pasta;
use PastaType;
use SauceType;


class BinarySearchTest extends TestCase
{
    private DynamicArray $array;

    protected function setUp(): void
    {
        $this->array = new DynamicArray();
        for ($i = 0; $i < 100; $i++) { 
            $this->array->add($i);
        }
    }

    public function testEmptyArray()
    {
        $this->array->clear();
        $result = binarySearch($this->array, 5);
        $this->assertFalse($result);
    }

    public function testElementNotFound()
    {
        $this->array->removeByElement(5);
        $result = binarySearch($this->array, 5);
        $this->assertFalse($result);
    }

    public function testElementFound()
    {
        $result = binarySearch($this->array, 5);
        $this->assertEquals(5, $result);
    }

    public function testElementFoundAtBeginning()
    {
        $result = binarySearch($this->array, 1);
        $this->assertEquals(1, $result);
    }

    public function testElementFoundAtEnd()
    {
        $result = binarySearch($this->array, 9);
        $this->assertEquals(9, $result);
    }

    public function testElementFoundAtMiddle()
    {
        $result = binarySearch($this->array, 50);
        $this->assertEquals(50, $result);
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $arrayName => $testData) {
                if (isSorted($testData)) {
                    $array = new DynamicArray(count($testData));
                    foreach ($testData as $value) {
                        $array->add($value);
                    }

                    foreach ($testData as $searchValue) {
                        $result = binarySearch($array, $searchValue);
                        // var_dump($result, $searchValue);
                        $this->assertEquals($searchValue, $result);
                    }
                } else {
                    var_dump($arrayName . ' is not sorted!!!' . "\n");
                }

                // Don't log to file because of infinite recursion in list.
            }
        }
    }
}