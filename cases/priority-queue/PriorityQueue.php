<?php

namespace Cases;

include(__DIR__ . '/../../cases/doubly-linked-list/DoublyLinkedList.php');

use Cases\DoublyLinkedList;
use PHPUnit\Event\Runtime\PHP;

class PriorityQueue
{
    private DoublyLinkedList $list;

    public function __construct()
    {
        $this->list = new DoublyLinkedList();
    }

    public function add(mixed $data, int $priority): void
    {
        if ($this->list->getSize() == 0) {
            $this->list->append(['data' => $data, 'priority' => $priority]);
        } else {
            $current = $this->list->start();
            $inserted = false;

            while ($current !== null) {
                if ($current['priority'] > $priority) {
                    $this->list->insertBefore($current, ['data' => $data, 'priority' => $priority]);
                    $inserted = true;
                    break;
                }
                $current = $this->list->next();
            }

            if (!$inserted) {
                $this->list->append(['data' => $data, 'priority' => $priority]);
            }
        }
    }

    public function peek(): mixed
    {
        if ($this->list->end() === null) {
            throw new \Exception('Queue is empty');
        }

        return $this->list->end()['data'] ?? null;
    }

    public function toArray(bool $simple = true): mixed
    {
        return $this->list->toArray($simple);
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