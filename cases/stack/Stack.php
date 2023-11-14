<?php

namespace Cases;

include(__DIR__ . '/../../cases/dynamic-array/DynamicArray.php');

use Cases\DynamicArray;

class Stack
{
    private DynamicArray $stack;

    public function __construct()
    {
        $this->stack = new DynamicArray();
    }

    public function push(mixed $data): void
    {
        $this->stack->add($data);
    }

    public function pop(): void
    {
        $this->stack->remove($this->getSize() - 1);
    }

    public function top(): mixed
    {
        return $this->stack->get($this->getSize() - 1);
    }

    public function isEmpty(): bool
    {
        return ($this->getSize() == 0);
    }

    public function getSize()
    {
        return $this->stack->getSize();
    }
}