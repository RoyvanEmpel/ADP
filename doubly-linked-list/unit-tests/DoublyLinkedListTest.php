<?php

namespace UnitTests;

include(__DIR__ . '/../DoublyLinkedList.php');

use PHPUnit\Framework\TestCase;
use Cases\DoublyLinkedList;

class DoublyLinkedListTest extends TestCase
{
    public function testAppend()
    {
        $list = new DoublyLinkedList();
        $list->append('first');
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('first', $list->get(0));
    }

    public function testPrepend()
    {
        $list = new DoublyLinkedList();
        $list->prepend('first');
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('first', $list->get(0));
    }

    public function testInsertAt()
    {
        $list = new DoublyLinkedList();
        $list->append('first');
        $list->append('second');
        $list->insertAt(1, 'middle');
        $this->assertEquals(3, $list->getSize());
        $this->assertEquals('middle', $list->get(1));
    }

    public function testRemove()
    {
        $list = new DoublyLinkedList();
        $list->append('first');
        $list->append('second');
        $list->remove(0);
        $this->assertEquals(1, $list->getSize());
        $this->assertEquals('second', $list->get(0));
    }

    public function testNextAndPrev()
    {
        $list = new DoublyLinkedList();
        $list->append('first');
        $list->append('second');
        $list->start();
        $this->assertEquals('second', $list->next());
        $this->assertEquals('first', $list->prev());
    }

    public function testOutOfBounds()
    {
        $this->expectException(\Exception::class);

        $list = new DoublyLinkedList();
        $list->append('first');
        $list->get(1);
    }

    
}
