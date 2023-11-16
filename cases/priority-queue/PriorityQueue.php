<?php

namespace Cases;

include(__DIR__ . '/../../cases/doubly-linked-list/DoublyLinkedList.php');

use Cases\DoublyLinkedList;

class PriorityQueue
{
    private DoublyLinkedList $list;

    public function __construct()
    {
        $this->list = new DoublyLinkedList();
    }

    public function add(mixed $data, int $priority): void
    {
        $this->list->start();

        while (isset($this->list->current()->next) && $this->list->current()['priority'] <= $priority) {
            $this->list->next();
        }

        if ($this->list->current()['priority'] < $priority) {
            $this->list->insertAfter($this->list->current(), ['data' => $data, 'priority' => $priority]);
        } else {
            $this->list->insertBefore($this->list->current(), ['data' => $data, 'priority' => $priority]);
        }
    }

    public function peek(): mixed
    {
        if ($this->list->end() === null) {
            throw new \Exception('Queue is empty');
        }

        return $this->list->end()['data'] ?? null;
    }

    public function poll(): mixed
    {
        if ($this->list->start() === null) {
            throw new \Exception('Queue is empty');
        }

        $data = $this->list->start()['data'];
        $this->list->shift();

        return $data;
    }

    public function insert(mixed $data, int $priority): void
    {
        $this->add($data, $priority);
    }

    public function findMin(): mixed
    {
        $this->list->start();

        if ($this->list->current() === null) {
            throw new \Exception('Queue is empty');
        }

        return $this->list->current()['data'];
    }

    public function deleteMin(): void
    {
        $this->list->start();

        if ($this->list->current() === null) {
            throw new \Exception('Queue is empty');
        }

        $this->list->shift();
    }
}
