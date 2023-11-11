<?php

namespace UnitTests;

include(__DIR__ . '/../DynamicArray.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\DynamicArray;
use RuntimeException;
use ValueError;
use Pasta;
use PastaType;
use SauceType;

class DynamicArrayTest extends TestCase
{
    public function testEmptyArray(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $this->expectException(RuntimeException::class);
        $this->assertEquals(0, $dynamicArray->get(0));
    }

    public function testAddAndGetElement(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $dynamicArray->add(5); // [ 0 => 5 ]
        $this->assertEquals(5, $dynamicArray->get(0));
    }

    public function testResize(): void
    {
        $dynamicArray = new DynamicArray(2); // [ 0 => null, 1 => null ]
        $dynamicArray->add(1); // [ 0 => 1, 1 => null ]
        $dynamicArray->add(2); // [ 0 => 1, 1 => 2 ]
        $dynamicArray->add(3); // [ 0 => 1, 1 => 2, 2 => 3 ]
        $this->assertEquals(3, $dynamicArray->get(2));
    }

    public function testRemove(): void
    {
        $dynamicArray = new DynamicArray(2); // [ 0 => null, 1 => null ]
        $dynamicArray->add(1); // [ 0 => 1, 1 => null ]
        $dynamicArray->add(2); // [ 0 => 1, 1 => 2 ]
        $dynamicArray->remove($dynamicArray->getSize() - 1); // [ 0 => 1 ]
        $this->assertEquals(1, $dynamicArray->get($dynamicArray->getSize() - 1));
    }

    public function testIndexOutOfRange(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $this->expectException(RuntimeException::class);
        $dynamicArray->get(1);
    }

    public function testEmptyArrayIndexZero(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $dynamicArray->add(0, null); // [ 0 => null ]
        $this->assertEquals(null, $dynamicArray->get(0));
    }

    public function testIndexGreaterThanCurrentSize(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $dynamicArray->set(10, 'Spaghetti'); // [ 0 => null, 1 => null, 2 => null ... 9 => null, 10 => 'Spaghetti' ]
        $this->assertEquals(null, $dynamicArray->get(1));
        $this->assertEquals('Spaghetti', $dynamicArray->get(10));
    }

    public function testSizeChangedAfterIndexSet(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $dynamicArray->set(10, 'Spaghetti'); // [ 0 => null, 1 => null, 2 => null, 3 => null, 4 => null ... 9 => null, 10 => 'Spaghetti' ]
        $dynamicArray->set(4, 'Fusilli'); // [ 0 => null, 1 => null, 2 => null, 3 => null, 4 => 'Fusilli' ... 9 => null, 10 => 'Spaghetti' ]
        $this->assertEquals(11, $dynamicArray->getSize());
    }

    public function testArraySize(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $dynamicArray->add(5); // [ 0 => 5 ]
        $dynamicArray->add(10); // [ 0 => 5, 1 => 10 ]
        $this->assertEquals(2, $dynamicArray->getSize());
    }

    public function testDifferentDataTypes(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        $dynamicArray->add(5); // [ 0 => 5 ]
        $dynamicArray->add('Spaghetti'); // [ 0 => 5, 1 => "Spaghetti" ]
        $this->assertEquals(5, $dynamicArray->get(0));
        $this->assertEquals('Spaghetti', $dynamicArray->get(1));
    }

    public function testLargeNumberOfElements(): void
    {
        $dynamicArray = new DynamicArray(); // [ ]
        for ($i = 0; $i < 1000000; $i++) {
            $dynamicArray->add($i); // [ $i => ... ]
        }
        $this->assertEquals(999999, $dynamicArray->get(999999));
    }

    public function testNegativeSize(): void
    {
        $this->expectException(ValueError::class);
        new DynamicArray(-5);
    }

    public function testDynamicPasta()
    {
        $dynamicArray = new DynamicArray(); // [ ]

        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $dynamicArray->add($pasta1); // [ 0 => Pasta object ]
        $this->assertEquals($pasta1, $dynamicArray->get($dynamicArray->getSize() - 1));

        $dynamicArray->add($pasta2); // [ 0 => Pasta object, 1 => Pasta object ]
        $this->assertEquals($pasta2, $dynamicArray->get($dynamicArray->getSize() - 1));

        $this->assertEquals("Een heerlijke Fusilli met Pesto saus.", $dynamicArray->get($dynamicArray->getSize() - 1)->description());

        $dynamicArray->remove($dynamicArray->getSize() - 1); // [ 0 => Pasta object ]
        $this->assertEquals("Een heerlijke Spaghetti met Tomatensaus saus.", $dynamicArray->get($dynamicArray->getSize() - 1)->description());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $dynamicArray = new DynamicArray(); // [ ]
                $this->assertEquals(0, $dynamicArray->getSize());

                // This index in the loop is the position of the value in the dynamic array.
                // It is not set in the file so it will automaticly be the same as from the dynamic array.
                foreach ($testData as $index => $value) {
                    $dynamicArray->add($value); // [ $value => ... ]
                    $this->assertEquals($value, $dynamicArray->get($index));
                }

                file_put_contents(__DIR__ . '/logs/DynamicArray-' . $key . '.log', var_export($dynamicArray, true));
            }
        }
    }
}