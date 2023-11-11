<?php

namespace UnitTests;

include(__DIR__ . '/../DynamicArray.php');

use Cases\DynamicArray;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use ValueError;
final class DynamicArrayTest extends TestCase
{
    public function testEmptyArray(): void
    {
        $dynamicArray = new DynamicArray();
        $this->assertEquals(0, $dynamicArray->get(0));
    }

    public function testAddAndGetElement(): void
    {
        $dynamicArray = new DynamicArray();
        $dynamicArray->add(5);
        $this->assertEquals(5, $dynamicArray->get(0));
    }

    public function testResize(): void
    {
        $dynamicArray = new DynamicArray(2);
        $dynamicArray->add(1);
        $dynamicArray->add(2);
        $dynamicArray->add(3);
        $this->assertEquals(3, $dynamicArray->get(2));
    }

    public function testIndexOutOfRange(): void
    {
        $dynamicArray = new DynamicArray();
        $this->expectException(RuntimeException::class);
        $dynamicArray->get(1);
    }

    public function testEmptyArrayIndexZero(): void
    {
        $dynamicArray = new DynamicArray();
        $this->assertEquals(null, $dynamicArray->get(0));
    }

    public function testIndexGreaterThanCurrentSize(): void
    {
        $dynamicArray = new DynamicArray();
        $dynamicArray->set(10, 'test');
        $this->assertEquals(null, $dynamicArray->get(1));
        $this->assertEquals('test', $dynamicArray->get(10));
    }

    public function testSizeChangedAfterIndexSet(): void
    {
        $dynamicArray = new DynamicArray();
        $dynamicArray->set(10, 'test');
        $dynamicArray->set(4, 'test2');
        $this->assertEquals(11, $dynamicArray->getSize());
    }

    public function testArraySize(): void
    {
        $dynamicArray = new DynamicArray();
        $dynamicArray->add(5);
        $dynamicArray->add(10);
        $this->assertEquals(2, $dynamicArray->getSize());
    }

    public function testDifferentDataTypes(): void
    {
        $dynamicArray = new DynamicArray();
        $dynamicArray->add(5);
        $dynamicArray->add("Hello");
        $this->assertEquals(5, $dynamicArray->get(0));
        $this->assertEquals("Hello", $dynamicArray->get(1));
    }

    public function testLargeNumberOfElements(): void
    {
        $dynamicArray = new DynamicArray();
        for ($i = 0; $i < 1000; $i++) {
            $dynamicArray->add($i);
        }
        $this->assertEquals(999, $dynamicArray->get(999));
    }

    public function testNegativeSize(): void
    {
        $this->expectException(ValueError::class);
        $dynamicArray = new DynamicArray(-5);
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $dynamicArray = new DynamicArray();

                // This index in the loop is the position of the value in the dynamic array.
                // It is not set in the file so it will automaticly be the same as from the dynamic array.
                foreach ($testData as $index => $value) {
                    $dynamicArray->add($value);
                    $this->assertEquals($value, $dynamicArray->get($index));
                }

                file_put_contents(__DIR__ . '/logs/DynamicArray-' . $key . '.log', var_export($dynamicArray, true));
            }
        }
    }
}