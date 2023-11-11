<?php

namespace UnitTests;

include(__DIR__ . '/../Stack.php');

use Cases\Stack;
use PHPUnit\Framework\TestCase;

class StackTest extends TestCase
{
    public function testPush()
    {
        $stack = new Stack();
        $stack->push(5);
        $this->assertEquals(1, $stack->getSize());
    }

    public function testPop()
    {
        $stack = new Stack();
        $stack->push(5);
        $stack->pop();
        $this->assertEquals(0, $stack->getSize());
    }

    public function testTopReturnsLastItem()
    {
        $stack = new Stack();
        $stack->push(5);
        $this->assertEquals(5, $stack->top());
    }

    public function testTopWhenEmpty()
    {
        $stack = new Stack();
        $this->assertEquals(null, $stack->top());
    }

    public function testIsEmptyWhenEmpty()
    {
        $stack = new Stack();
        $this->assertTrue($stack->isEmpty());
    }

    public function testIsEmptyWhenNotEmpty()
    {
        $stack = new Stack();
        $stack->push(5);
        $this->assertFalse($stack->isEmpty());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $stack = new Stack();
                $this->assertEquals(true, $stack->isEmpty());

                // This index in the loop is the position of the value in the dynamic array.
                // It is not set in the file so it will automaticly be the same as from the dynamic array.
                foreach ($testData as $index => $value) {
                    $stack->push($value);
                    $this->assertEquals($value, $stack->top($index));
                }

                file_put_contents(__DIR__ . '/logs/StackTest-' . $key . '.log', var_export($stack, true));
            }
        }
    }
}
