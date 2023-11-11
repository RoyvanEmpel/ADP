<?php

namespace UnitTests;

include(__DIR__ . '/../Stack.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\Stack;
use Pasta;
use PastaType;
use SauceType;

class StackTest extends TestCase
{
    public function testPush()
    {
        $stack = new Stack(); // [ ]
        $stack->push(5); // [ 0 => 5 ]
        $this->assertEquals(1, $stack->getSize());
    }

    public function testPop()
    {
        $stack = new Stack();  // [ ]
        $stack->push(5); // [ 0 => 5 ]
        $stack->pop(); // [ ]
        $this->assertEquals(0, $stack->getSize());
    }

    public function testTopReturnsLastItem()
    {
        $stack = new Stack(); // [ ]
        $stack->push(5); // [ 0 => 5 ]
        $stack->push(12); // [ 0 => 5, 1 => 12 ]
        $this->assertEquals(12, $stack->top());
    }

    public function testTopWhenEmpty()
    {
        $stack = new Stack(); // [ ]
        $this->assertEquals(null, $stack->top());
    }

    public function testIsEmptyWhenEmpty()
    {
        $stack = new Stack(); // [ ]
        $this->assertTrue($stack->isEmpty());
    }

    public function testIsEmptyWhenNotEmpty()
    {
        $stack = new Stack(); // [ ]
        $stack->push(5); // [ 0 => 5 ]
        $this->assertFalse($stack->isEmpty());
    }

    public function testStackPasta()
    {
        $stack = new Stack(); // [ ]

        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $stack->push($pasta1); // [ 0 => Pasta object ]
        $this->assertEquals($pasta1, $stack->top());

        $stack->push($pasta2); // [ 0 => Pasta object, 1 => Pasta object ]
        $this->assertEquals($pasta2, $stack->top());

        $this->assertEquals("Een heerlijke Fusilli met Pesto saus.", $stack->top()->description());

        $stack->pop();  // [ 0 => Pasta object ]
        $this->assertEquals("Een heerlijke Spaghetti met Tomatensaus saus.", $stack->top()->description());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $stack = new Stack(); // [ ]
                $this->assertEquals(true, $stack->isEmpty());

                foreach ($testData as $value) {
                    $stack->push($value);  // [ $value => ... ]
                    $this->assertEquals($value, $stack->top());
                }

                $filename = __DIR__ . '/logs/StackTest-' . $key . '.log';
                if (!file_exists($filename)) {
                    fopen($filename, 'w');
                }

                file_put_contents($filename, var_export($dynamicArray, true));
            }
        }
    }
}
