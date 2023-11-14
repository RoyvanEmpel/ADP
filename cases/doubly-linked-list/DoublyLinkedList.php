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

    public function insertBefore(mixed $searchData, mixed $newData): void
    {
        $node = new Node($newData);
        
        $foundNode = $this->search($searchData);
        
        $node->next = &$foundNode;
        $node->prev = &$foundNode->prev;

        if ($foundNode->has('prev')) {
            $foundNode->prev->next = &$node;
        } else {
            $this->head = &$node;
        }

        $foundNode->prev = &$node;

        $this->size++;
    }

    public function insertAfter(mixed $searchData, mixed $newData): void
    {
        $node = new Node($newData);
        
        $foundNode = $this->search($searchData);
        
        $node->prev = &$foundNode;
        $node->next = &$foundNode->next;

        if ($foundNode->has('next')) {
            $foundNode->next->prev = &$node;
        } else {
            $this->head = &$node;
        }

        $foundNode->next = &$node;

        $this->size++;
    }

    public function get(mixed $value): mixed
    {
        return $this->search($value)->data;
    }

    public function remove(mixed $value)
    {
        $node = $this->search($value);

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

    private function search(mixed $data): Node
    {
        $head = &$this->head;
        for ($i = 0; $i < $this->size; $i++) {
            if ($data === $head->data) {
                return $head;
            }

            $head = &$head->next;

            if ($head === null) {
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