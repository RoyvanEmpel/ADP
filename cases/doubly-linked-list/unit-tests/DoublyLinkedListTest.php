<?php

namespace UnitTests;

include(__DIR__ . '/../DoublyLinkedList.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\DoublyLinkedList;
// use Exception;
use Pasta;
use PastaType;
use SauceType;

class DoublyLinkedListTest extends TestCase
{
    private DoublyLinkedList $list;

    protected function setUp(): void
    {
        $this->list = new DoublyLinkedList();
    }

    public function testNewListIsEmpty()
    {
        $this->assertEquals(0, $this->list->getSize());
    }

    public function testAppendIncreasesSize()
    {
        $this->list->append('Pesto');
        $this->assertEquals(1, $this->list->getSize());
    }

    public function testPrependIncreasesSize()
    {
        $this->list->prepend('Pesto');
        $this->assertEquals(1, $this->list->getSize());
    }

    public function testInsertBefore()
    {
        $this->list->append('Spaghetti');
        $this->list->insertBefore('Spaghetti', 'Penne');
        $this->assertEquals(2, $this->list->getSize());
    }

    public function testInsertAfter()
    {
        $this->list->append('Spaghetti');
        $this->list->insertAfter('Spaghetti', 'Fusilli');
        $this->assertEquals(2, $this->list->getSize());
    }

    public function testShiftRemovesFirstElement()
    {
        $this->list->append('Spaghetti');
        $this->list->append('Fusilli');
        $shifted = $this->list->shift();
        $this->assertEquals('Spaghetti', $shifted);
        $this->assertEquals(1, $this->list->getSize());
    }

    public function testPopRemovesLastElement()
    {
        $this->list->append('Spaghetti');
        $this->list->append('Fusilli');
        $popped = $this->list->pop();
        $this->assertEquals('Fusilli', $popped);
        $this->assertEquals(1, $this->list->getSize());
    }

    public function testRemove()
    {
        $this->list->append('Spaghetti');
        $this->list->append('Fusilli');
        $this->list->remove('Spaghetti');
        $this->assertEquals(1, $this->list->getSize());
    }

    public function testNextPrevCurrent()
    {
        $this->list->append('Spaghetti');
        $this->list->append('Fusilli');
        $this->list->append('Tagliatelle');
        $this->assertEquals('Spaghetti', $this->list->start());
        $this->assertEquals('Fusilli', $this->list->next());
        $this->assertEquals('Spaghetti', $this->list->prev());
        $this->assertEquals('Spaghetti', $this->list->current());
    }

    public function testStartEnd()
    {
        $this->list->append('Spaghetti');
        $this->list->append('Fusilli');
        $this->assertEquals('Spaghetti', $this->list->start());
        $this->assertEquals('Fusilli', $this->list->end());
    }

    public function testFindContains()
    {
        $this->list->append('Spaghetti');
        $this->assertNotNull($this->list->find('Spaghetti'));
        $this->assertTrue($this->list->contains('Spaghetti'));
        $this->assertFalse($this->list->contains('Fusilli'));
    }

    public function testToArray()
    {
        $this->list->append('Spaghetti');
        $this->list->append('Fusilli');
        $expectedArray = [
            var_export('Spaghetti', true) => ['prev' => null, 'next' => 'Fusilli'],
            var_export('Fusilli', true) => ['prev' => 'Spaghetti', 'next' => null]
        ];

        $this->assertEquals($expectedArray, $this->list->toArray());
    }

    public function testPastaInsert()
    {
        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta3 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $this->list->append($pasta1); // [ 0 => $pasta1 ]
        $this->list->append($pasta2); // [ 0 => $pasta1, 1 => $pasta2 ]
        $this->list->start();
        
        $this->assertEquals($pasta2, $this->list->next());
        $this->assertEquals($pasta3, $this->list->prev());

        $this->assertEquals('Een heerlijke Fusilli met Pesto saus.', $this->list->next()->description());
        $this->assertEquals('Een heerlijke Spaghetti met Tomatensaus saus.', $this->list->prev()->description());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $this->setUp();
                $this->assertEquals(0, $this->list->getSize());

                // This index in the loop is the position of the value in the DoublyLinkedList.
                // It is not set in the file so it will automaticly be the same as from the doubly linked list.
                foreach ($testData as $value) {
                    $this->list->append($value);
                    $this->assertEquals($value, $this->list->end());
                }

                $filename = __DIR__ . '/logs/DoublyLinkedList-' . $key . '.log';
                if (!file_exists($filename)) {
                    fopen($filename, 'w');
                } else {
                    unlink($filename);
                }

                file_put_contents($filename, var_export($this->list->toArray(), true));
            }
        }
    }
}