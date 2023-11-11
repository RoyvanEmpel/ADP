<?php

namespace UnitTests;

include(__DIR__ . '/../DoublyLinkedList.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\DoublyLinkedList;
use Exception;
use Pasta;
use PastaType;
use SauceType;

class DoublyLinkedListTest extends TestCase
{
    public function testAppend()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti'); // [ 0 => 'Spaghetti' ]
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('Spaghetti', $list->get(0));
    }

    public function testPrepend()
    {
        $list = new DoublyLinkedList();
        $list->prepend('Spaghetti'); // [ 0 => 'Spaghetti' ]
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('Spaghetti', $list->get(0));
    }

    public function testInsertAt()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti'); // [ 0 => 'Spaghetti' ]
        $list->append('Fusilli'); // [ 0 => 'Spaghetti', 1 => 'Fusilli' ]
        $list->insertAt(1, 'Pizza'); // [ 0 => 'Spaghetti', 1 => 'Pizza', 2 => 'Fusilli' ]
        $this->assertEquals(3, $list->getSize());
        $this->assertEquals('Pizza', $list->get(1));
    }

    public function testRemove()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti'); // [ 0 => 'Spaghetti' ]
        $list->append('Fusilli'); // [ 0 => 'Spaghetti', 1 => 'Fusilli' ]
        $list->remove(0); // [ 0 => 'Fusilli' ]
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('Fusilli', $list->get(0));
    }

    public function testNextAndPrev()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti'); // [ 0 => 'Spaghetti' ]
        $list->append('Fusilli'); // [ 0 => 'Spaghetti', 1 => 'Fusilli' ]
        $list->start();
        $this->assertEquals('Fusilli', $list->next());
        $this->assertEquals('Spaghetti', $list->prev());
    }

    public function testOutOfBounds()
    {
        $this->expectException(\Exception::class);

        $list = new DoublyLinkedList();
        $list->append('Spaghetti'); // [ 0 => 'Spaghetti' ]
        $list->get(1); // Spaghetti
    }

    public function testLargeNumberOfElements(): void
    {
        $list = new DoublyLinkedList();
        for ($i = 0; $i < 1000000; $i++) {
            $list->append($i);
        }
        $this->assertEquals(999999, $list->get(999999));
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
                foreach ($testData as $index => $value) {
                    $list->append($value);
                    $this->assertEquals($value, $list->get($index));
                }

                // Don't log to file because of infinite recursion in list.
            }
        }
    }
}