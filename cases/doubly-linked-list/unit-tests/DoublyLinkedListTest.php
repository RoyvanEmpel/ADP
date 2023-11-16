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
    private DoublyLinkedList $list;

    protected function setUp(): void
    {
        $this->list = new DoublyLinkedList();
    }

    public function testAppend()
    {
        $this->list->append('Spaghetti'); // [ 'Spaghetti' ]
        $this->assertEquals(1, $this->list->getSize());
        $this->assertEquals('Spaghetti', $this->list->find('Spaghetti'));
    }

    public function testPrepend()
    {
        $this->list->append('Spaghetti 1'); // [ 'Spaghetti 1' ]
        $this->list->append('Spaghetti 2'); // [ 'Spaghetti 1', 'Spaghetti 2' ]
        $this->list->prepend('Spaghetti 3'); // [ 'Spaghetti 3', 'Spaghetti 1', 'Spaghetti 2' ]
        $this->assertEquals(3, $this->list->getSize());
        $this->assertEquals('Spaghetti 3', $this->list->find('Spaghetti 3'));
    }

    public function testInsertBefore(): void
    {
        $this->list->append('A');
        $this->list->append('C');

        $this->list->insertBefore('C', 'B');

        $this->assertEquals('A', $this->list->start()->data);
        $this->assertEquals('B', $this->list->next());
        $this->assertEquals('C', $this->list->next());
        $this->assertEquals('B', $this->list->prev());
        $this->assertEquals(3, $this->list->getSize());
    }

    public function testInsertAfter(): void
    {
        $this->list->append('A');
        $this->list->append('C');

        $this->list->insertAfter('A', 'B');

        $this->assertEquals('A', $this->list->start()->data);
        $this->assertEquals('B', $this->list->next());
        $this->assertEquals('C', $this->list->next());
        $this->assertEquals('B', $this->list->prev());
        $this->assertEquals(3, $this->list->getSize());
    }

    public function testRemove()
    {
        $this->list->append('Spaghetti'); // [ 'Spaghetti' ]
        $this->list->append('Fusilli'); // [ 'Spaghetti', 'Fusilli' ]
        $this->list->remove('Spaghetti'); // [ 'Fusilli' ]
        $this->assertEquals(1, $this->list->getSize());
        $this->assertEquals('Fusilli', $this->list->find('Fusilli'));
    }

    public function testNextAndPrev()
    {
        $this->list->append('Spaghetti'); // [ 'Spaghetti' ]
        $this->list->append('Fusilli'); // [ 'Spaghetti', 'Fusilli' ]
        $this->list->start();
        $this->assertEquals('Fusilli', $this->list->next());
        $this->assertEquals('Spaghetti', $this->list->prev());
    }

    public function testOutOfBounds()
    {
        $this->expectException(\Exception::class);

        $this->list->append('Spaghetti'); // [ 'Spaghetti' ]
        $this->list->find('Fusilli');
    }

    public function testFind()
    {
        $pasta = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $this->list->append($pasta);

        // The get method executes the find method.
        $returnedPasta = $this->list->find($pasta);
        $this->assertEquals($pasta, $returnedPasta);
    }

    public function testLargeNumberOfElements(): void
    {
        for ($i = 0; $i < 1000000; $i++) {
            $this->list->append($i);
        }
        $this->assertEquals(999999, $this->list->find(999999));
    }

    public function testPastaInsert()
    {
        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $this->list->append($pasta1); // [ 0 => $pasta1 ]
        $this->list->append($pasta2); // [ 0 => $pasta1, 1 => $pasta2 ]
        $this->list->start();
        
        $this->assertEquals($pasta2, $this->list->next());
        $this->assertEquals($pasta1, $this->list->prev());

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
            foreach ($jsonContents as $testData) {
                $list = new DoublyLinkedList();
                $this->assertEquals(0, $list->getSize());

                // This index in the loop is the position of the value in the DoublyLinkedList.
                // It is not set in the file so it will automaticly be the same as from the doubly linked list.
                foreach ($testData as $value) {
                    $list->append($value);
                    $this->assertEquals($value, $list->find($value));
                }

                // Don't log to file because of infinite recursion in list.
            }
        }
    }
}
