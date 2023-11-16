<?php

namespace UnitTests;

include(__DIR__ . '/../Deque.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\Deque;
use Pasta;
use PastaType;
use SauceType;


class DequeTest extends TestCase
{
    public function testInsertLeft(): void
    {
        $deque = new Deque();
        $deque->insertLeft("a");
        $this->assertSame(1, $deque->getSize());
    }

    public function testInsertRight(): void
    {
        $deque = new Deque();
        $deque->insertRight("a");
        $this->assertSame(1, $deque->getSize());
    }

    public function testDeleteLeft(): void
    {
        $deque = new Deque();

        $deque->insertLeft("a");
        $deque->insertLeft("b");
        $deque->insertLeft("c");

        $this->assertEquals("c", $deque->deleteLeft());
        $this->assertEquals("b", $deque->deleteLeft());
        $this->assertEquals("a", $deque->deleteLeft());
        $this->assertSame(0, $deque->getSize());
    }

    public function testDeleteRight(): void
    {
        $deque = new Deque();
        
        $deque->insertRight("a");
        $deque->insertRight("b");
        $deque->insertRight("c");

        $this->assertEquals("c", $deque->deleteRight());
        $this->assertEquals("b", $deque->deleteRight());
        $this->assertEquals("a", $deque->deleteRight());
        $this->assertSame(0, $deque->getSize());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $testData) {
                $list = new Deque();
                $this->assertEquals(0, $list->getSize());

                $counter = 0;
                foreach ($testData as $value) {
                    $list->insertRight($value);
                    $counter++;

                    $this->assertEquals($counter, $list->getSize());
                }

                // Don't log to file because of infinite recursion in list.
            }
        }
    }
}