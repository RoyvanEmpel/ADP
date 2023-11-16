<?php

namespace Cases;

include(__DIR__ . '/../../cases/doubly-linked-list/DoublyLinkedList.php');

use Cases\DoublyLinkedList;

class Deque {
    private DoublyLinkedList $deque;

    public function __construct()
    {
        $this->deque = new DoublyLinkedList();
    }

    public function insertLeft(mixed $value): void
    {
        $this->deque->append($value);
    }

    public function insertRight(mixed $value): void
    {
        $this->deque->prepend($value);
    }

    public function deleteLeft(): mixed
    {
        $firstItem = $this->deque->start();
        $this->deque->remove($firstItem);
        return $firstItem;
    }

    public function deleteRight(): mixed
    {
        $lastItem = $this->deque->end();
        $this->deque->remove($lastItem);
        return $lastItem;
    }

    public function getSize(): int
    {
        return $this->deque->getSize();
    }
}