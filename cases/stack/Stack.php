<?php

namespace Cases;

include(__DIR__ . '/../../cases/dynamic-array/DynamicArray.php');

use Cases\DynamicArray;

class Stack
{
    private DynamicArray $stack;

    public function __construct() {
        $this->stack = new DynamicArray();
    }

    public function push(mixed $data): void
    {
        $this->stack->add($data);
    }

    public function pop(): void
    {
        if (!$this->isEmpty()) {
            $this->stack->remove($this->stack->getSize() - 1);
        }
    }

    public function top(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }

        return $this->stack->get($this->stack->getSize() - 1);
    }

    public function isEmpty(): bool
    {
        return ($this->stack->getSize() == 0);
    }

    public function getSize()
    {
        return $this->stack->getSize();
    }
}