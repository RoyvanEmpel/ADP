<?php

namespace Cases;

class DoublyLinkedList
{
    private ?Node $head = null;
    private ?Node $tail = null;
    private ?Node $current = null;
    private int $size = 0;

    public function __construct()
    {
        $this->head = new Node();
        $this->tail = new Node();

        $this->head->next = &$this->tail;
        $this->tail->prev = &$this->head;
    }

    public function append(mixed $data): void
    {
        $node = new Node($data);

        $node->prev = &$this->tail->prev;
        $node->next = &$this->tail;

        $this->tail->prev->next = &$node;
        $this->tail->prev = &$node;

        $this->size++;
    }

    public function prepend(mixed $data): void
    {
        $node = new Node($data);

        $node->prev = &$this->head;
        $node->next = &$this->head->next;

        $this->head->next->prev = &$node;
        $this->head->next = &$node;

        $this->size++;
    }

    public function insertBefore(mixed $before, mixed $data): void
    {
        $node = new Node($data);
        
        $foundNode = $this->find($before);

        $foundNode->prev->next = &$node;
        $node->prev = &$foundNode->prev;

        $foundNode->prev = &$node;
        $node->next = &$foundNode;

        $this->size++;
    }

    public function insertAfter(mixed $after, mixed $data): void
    {
        $node = new Node($data);
        
        $foundNode = $this->find($after);

        $foundNode->next->prev = &$node;
        $node->next = &$foundNode->next;

        $foundNode->next = &$node;
        $node->prev = &$foundNode;

        $this->size++;
    }

    public function shift(): mixed
    {
        $data = $this->head->next->data;

        $this->head->next = &$this->head->next->next;
        $this->head->next->prev = &$this->head;

        $this->size--;

        return $data;
    }

    public function pop(): mixed
    {
        $data = $this->tail->prev->data;

        $this->tail->prev = &$this->tail->prev->prev;
        $this->tail->prev->next = &$this->tail;

        $this->size--;

        return $data;
    }

    public function remove(mixed $value): void
    {
        $node = $this->find($value);

        $node->prev->next = &$node->next;
        $node->next->prev = &$node->prev;

        $this->size--;
    }

    public function next(): mixed
    {
        if ($this->current === null) {
            $this->current = &$this->head->next;
        }

        $this->current = &$this->current->next;

        if (!isset($this->current->next)) {
            throw new \Exception('Out of range');
        }

        return $this->current->data;
    }

    public function prev(): mixed
    {
        if ($this->current === null) {
            $this->current = &$this->head->next;
        }

        $this->current = &$this->current->prev;

        if (!isset($this->current->prev)) {
            throw new \Exception('Out of range');
        }

        return $this->current->data;
    }

    public function current(): mixed
    {
        if (!isset($this->current->next) || !isset($this->current->prev)) {
            return null;
        }

        return $this->current?->data;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function start(): mixed
    {
        $this->current = &$this->head->next;

        if (!isset($this->current->next) || !isset($this->current->prev)) {
            return null;
        }

        return $this->current->data;
    }

    public function end(): mixed
    {
        $this->current = &$this->tail->prev;

        if (!isset($this->current->next) || !isset($this->current->prev)) {
            return null;
        }

        return $this->current->data;
    }

    public function find(mixed $data): ?Node
    {
        $node = &$this->head->next;

        while (isset($node->next)) {
            if ($data === $node->data) {
                return $node;
            }
            $node = &$node->next;
        }

        throw new \Exception('Data not found in list');
    }

    public function contains(mixed $data): bool
    {
        try {
            $this->find($data);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function toArray(): array
    {
        $node = &$this->head->next;
        $array = [];

        while (isset($node->next)) {
            $array[$node->data] = [
                'prev' => $node->prev?->data,
                'next' => $node->next?->data,
            ];
            $node = &$node->next;
        }

        return $array;
    }
}

class Node
{
    public mixed $data;
    public ?Node $next;
    public ?Node $prev;

    public function __construct(mixed $data = null)
    {
        $this->data = $data;
    }
}