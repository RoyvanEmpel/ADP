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
        $this->deque->prepend($value);
    }

    public function insertRight(mixed $value): void
    {
        $this->deque->append($value);
    }

    public function deleteLeft(): mixed
    {
        return $this->deque->shift();
    }

    public function deleteRight(): mixed
    {
        return $this->deque->pop();
    }

    public function getSize(): int
    {
        return $this->deque->getSize();
    }
}