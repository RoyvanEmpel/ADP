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
    public function testNewListIsEmpty()
    {
        $list = new DoublyLinkedList();
        $this->assertEquals(0, $list->getSize());
    }

    public function testAppendIncreasesSize()
    {
        $list = new DoublyLinkedList();
        $list->append('Pesto');
        $this->assertEquals(1, $list->getSize());
    }

    public function testPrependIncreasesSize()
    {
        $list = new DoublyLinkedList();
        $list->prepend('Pesto');
        $this->assertEquals(1, $list->getSize());
    }

    public function testInsertBefore()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->insertBefore('Spaghetti', 'Penne');
        $this->assertEquals(2, $list->getSize());
    }

    public function testInsertAfter()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->insertAfter('Spaghetti', 'Fusilli');
        $this->assertEquals(2, $list->getSize());
    }

    public function testShiftRemovesFirstElement()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $shifted = $list->shift();
        $this->assertEquals('Spaghetti', $shifted);
        $this->assertEquals(1, $list->getSize());
    }

    public function testPopRemovesLastElement()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $popped = $list->pop();
        $this->assertEquals('Fusilli', $popped);
        $this->assertEquals(1, $list->getSize());
    }

    public function testRemove()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $list->remove('Spaghetti');
        $this->assertEquals(1, $list->getSize());
    }

    public function testNextPrevCurrent()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $list->append('Tagliatelle');
        $this->assertEquals('Spaghetti', $list->start());
        $this->assertEquals('Fusilli', $list->next());
        $this->assertEquals('Spaghetti', $list->prev());
        $this->assertEquals('Spaghetti', $list->current());
    }

    public function testStartEnd()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $this->assertEquals('Spaghetti', $list->start());
        $this->assertEquals('Fusilli', $list->end());
    }

    public function testFindContains()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $this->assertNotNull($list->find('Spaghetti'));
        $this->assertTrue($list->contains('Spaghetti'));
        $this->assertFalse($list->contains('Fusilli'));
    }

    public function testToArray()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $expectedArray = [
            var_export('Spaghetti', true) => ['prev' => null, 'next' => 'Fusilli'],
            var_export('Fusilli', true) => ['prev' => 'Spaghetti', 'next' => null]
        ];

        $this->assertEquals($expectedArray, $list->toArray());
    }

    public function testPastaInsert()
    {
        $list = new DoublyLinkedList();

        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $list->append($pasta1); // [ 0 => $pasta1 ]
        $list->append($pasta2); // [ 0 => $pasta1, 1 => $pasta2 ]
        $list->start();
        
        $this->assertEquals($pasta2, $list->next());
        $this->assertEquals($pasta1, $list->prev());

        $this->assertEquals('Een heerlijke Fusilli met Pesto saus.', $list->next()->description());
        $this->assertEquals('Een heerlijke Spaghetti met Tomatensaus saus.', $list->prev()->description());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $list = new DoublyLinkedList();
                $this->assertEquals(0, $list->getSize());

                // This index in the loop is the position of the value in the DoublyLinkedList.
                // It is not set in the file so it will automaticly be the same as from the doubly linked list.
                foreach ($testData as $value) {
                    $list->append($value);
                    $this->assertEquals($value, $list->end());
                }

                $filename = __DIR__ . '/logs/DoublyLinkedList-' . $key . '.log';
                if (!file_exists($filename)) {
                    fopen($filename, 'w');
                } else {
                    unlink($filename);
                }

                file_put_contents($filename, var_export($list->toArray(), true));
            }
        }
    }
}