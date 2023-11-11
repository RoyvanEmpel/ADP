<?php

namespace UnitTests;

include(__DIR__ . '/../DoublyLinkedList.php');
include(__DIR__ . '/../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\DoublyLinkedList;
use Pasta;
use PastaType;
use SauceType;

class DoublyLinkedListTest extends TestCase
{
    public function testAppend()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('Spaghetti', $list->get(0));
    }

    public function testPrepend()
    {
        $list = new DoublyLinkedList();
        $list->prepend('Spaghetti');
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('Spaghetti', $list->get(0));
    }

    public function testInsertAt()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $list->insertAt(1, 'middle');
        $this->assertEquals(3, $list->getSize());
        $this->assertEquals('middle', $list->get(1));
    }

    public function testRemove()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $list->remove(0);
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('Fusilli', $list->get(0));
    }

    public function testNextAndPrev()
    {
        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->append('Fusilli');
        $list->start();
        $this->assertEquals('Fusilli', $list->next());
        $this->assertEquals('Spaghetti', $list->prev());
    }

    public function testOutOfBounds()
    {
        $this->expectException(\Exception::class);

        $list = new DoublyLinkedList();
        $list->append('Spaghetti');
        $list->get(1);
    }

    public function testPastaInsert()
    {
        $list = new DoublyLinkedList();

        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $list->append($pasta1);
        $list->append($pasta2);
        $list->start();
        
        $this->assertEquals($pasta2, $list->next());
        $this->assertEquals($pasta1, $list->prev());

        $this->assertEquals("Een heerlijke Fusilli met Pesto saus.", $list->next()->description());
        $this->assertEquals("Een heerlijke Spaghetti met Tomatensaus saus.", $list->prev()->description());
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                $list = new DoublyLinkedList();
                $this->assertEquals(0, $list->getSize());

                // This index in the loop is the position of the value in the dynamic array.
                // It is not set in the file so it will automaticly be the same as from the dynamic array.
                foreach ($testData as $index => $value) {
                    $list->append($value);
                    $this->assertEquals($value, $list->get($index));
                }

                file_put_contents(__DIR__ . '/logs/list-' . $key . '.log', var_export($list, true));
            }
        }
    }
}
