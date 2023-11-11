<?php

namespace Cases;

class DoublyLinkedList
{
    private ?Node $head = null;
    private ?Node $tail = null;
    private ?Node $current = null;
    private int $size = 0;

    public function append(mixed $data): void
    {
        $node = new Node($data);

        if ($this->head === null) {
            $this->head = &$node;
            $this->tail = &$node;
            $this->current = &$node;
        } else {
            $this->tail->next = &$node;
            $node->prev = &$this->tail;
            $this->tail = &$node;
        }

        $this->size++;
    }

    public function prepend(mixed $data): void
    {
        $node = new Node($data);

        $this->current = &$node;

        if ($this->head === null) {
            $this->head = &$node;
            $this->tail = &$node;
        } else {
            $this->head->prev = &$node;
            $node->next = &$this->head;
            $this->head = &$node;
        }

        $this->size++;
    }

    public function insertAt(int $index, mixed $data): void
    {
        $node = new Node($data);
        
        $foundNode = $this->search($index);
        
        $node->prev = &$foundNode->prev;
        $node->next = &$foundNode;

        if ($foundNode->has('prev')) {
            $foundNode->prev->next = &$node;
        } else {
            $this->head = &$node;
        }

        $foundNode->prev = &$node;

        $this->size++;
    }

    public function get(int $index): mixed
    {
        return $this->search($index)->data;
    }

    public function remove(int $index)
    {
        $node = $this->search($index);

        if ($this->current === $node) {
            $this->current = &$this->head;
        }

        if ($node->has('prev')) {
            $node->prev->next = &$node->next;
        } else {
            $this->head = &$node->next;
        }

        if ($node->has('next')) {
            $node->next->prev = &$node->prev;
        } else {
            $this->tail = &$node->prev;
        }

        $this->size--;
    }

    public function next(): mixed
    {
        $this->current = &$this->current->next;

        if ($this->current === null) {
            throw new \Exception('Index out of range');
        }

        return $this->current->data;
    }

    public function prev(): mixed
    {
        $this->current = &$this->current->prev;

        if ($this->current === null) {
            throw new \Exception('Index out of range');
        }

        return $this->current->data;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function start(): ?Node
    {
        $this->current = &$this->head;
        return $this->head;
    }

    public function end(): ?Node
    {
        $this->current = &$this->tail;
        return $this->tail;
    }

    public function current(): ?Node
    {
        return $this->current;
    }

    private function search(int $index): Node
    {
        if ($index < ($this->size / 2)) {
            return $this->searchFromHead($index);
        } else {
            return $this->searchFromTail($index);
        }
    }

    private function searchFromHead(int $index): Node
    {
        $head = &$this->head;
        for ($i = 0; $i < $this->size; $i++) {
            if ($i === $index) {
                return $head;
            }

            $head = &$head->next;

            if ($head === null) {
                throw new \Exception('Index out of range');
            }
        }
    }

    private function searchFromTail(int $index): Node
    {
        $tail = &$this->tail;
        for ($i = ($this->size - 1); $i >= 0; $i--) {
            if ($i === $index) {
                return $tail;
            }

            $tail = &$tail->prev;

            if ($tail === null) {
                throw new \Exception('Index out of range');
            }
        }
    }

}

class Node
{
    public mixed $data;
    public ?Node $next;
    public ?Node $prev;

    public function __construct(mixed $data)
    {
        $this->data = $data;
    }

    public function has(string|array $type): bool
    {
        if (is_string($type)) {
            return isset($this->$type);
        }

        foreach ($type as $value) {
            if (!isset($this->$value)) {
                return false;
            }
        }

        return true;
    }
}