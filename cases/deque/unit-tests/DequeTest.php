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
    private Deque $deque;

    protected function setUp(): void
    {
        $this->deque = new Deque();
    }

    public function testInsertLeft(): void
    {
        $this->deque->insertLeft("a");
        $this->assertSame(1, $this->deque->getSize());
    }

    public function testInsertRight(): void
    {
        $this->deque->insertRight("a");
        $this->assertSame(1, $this->deque->getSize());
    }

    public function testDeleteLeft(): void
    {
        $this->deque->insertLeft("a");
        $this->deque->insertLeft("b");
        $this->deque->insertLeft("c");

        $this->assertEquals("c", $this->deque->deleteLeft());
        $this->assertEquals("b", $this->deque->deleteLeft());
        $this->assertEquals("a", $this->deque->deleteLeft());
        $this->assertSame(0, $this->deque->getSize());
    }

    public function testDeleteRight(): void
    {
        $this->deque->insertRight("a");
        $this->deque->insertRight("b");
        $this->deque->insertRight("c");

        $this->assertEquals("c", $this->deque->deleteRight());
        $this->assertEquals("b", $this->deque->deleteRight());
        $this->assertEquals("a", $this->deque->deleteRight());
        $this->assertSame(0, $this->deque->getSize());
    }

    public function testPastaDeque()
    {
        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $this->deque->insertRight($pasta1); // [ 0 => $pasta1 ]
        $this->deque->insertRight($pasta2); // [ 0 => $pasta1, 1 => $pasta2 ]
        
        $this->assertEquals($pasta2, $this->deque->deleteRight());
        $this->assertEquals($pasta1, $this->deque->deleteRight());
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