<?php

namespace Cases;

use SplFixedArray;

class DynamicArray
{
    private SplFixedArray $array;
    private int $size = 0;
    private int $current = 0;

    public function __construct(int $size = 0)
    {
        $this->array = new SplFixedArray($size);
    }

    public function get(int $index): mixed
    {
        return $this->array[$index];
    }

    public function getAll(): SplFixedArray
    {
        return $this->array;
    }

    public function set(?int $index, mixed $value): void
    {
        while ( $this->array->getSize() == 0 || ($index / $this->array->getSize()) >= 1 ) {
            $this->resize();
        }

        $this->array[$index] = $value;
        $this->size++;

        if ($index > $this->current) {
            $this->current = $index;
        }
    }

    public function add(mixed $value): void
    {
        $this->set($this->current++, $value);
    }

    public function remove(int $index): void
    {
        unset($this->array[$index]);
        $this->size--;
    }

    public function removeByElement(mixed $value): void
    {
        $index = $this->find($value);
        
        $this->remove($index);
    }

    public function clear()
    {
        $this->array = new SplFixedArray($this->getSize());
        $this->size = 0;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    private function resize(): void
    {
        $oldArray = $this->array;
        $newArray = new SplFixedArray(($this->array->getSize() * 2) + 1);

        foreach ($oldArray as $key => $value) {
            $newArray[$key] = $value;
        }

        $this->array = $newArray;
    }

    public function find(mixed $value): ?int
    {
        $i = 0;
        while (true) {
            if ($this->array[$i] === $value) {
                return $i;
            }

            $i++;
        }

        return null;
    }

    public function contains(mixed $value): bool
    {
        if ($this->find($value) !== null) {
            return true;
        }

        return false;
    }
}