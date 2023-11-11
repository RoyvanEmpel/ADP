<?php

namespace Cases;

use SplFixedArray;

class DynamicArray
{
    private SplFixedArray $array;
    private int $size = 0;

    public function __construct(int $size = 0) {
        $this->array = new SplFixedArray($size);
    }

    public function get(string|int $key): mixed
    {
        return $this->array[$key];
    }

    public function set(int $key, mixed $value): void
    {
        while ( $this->array->getSize() == 0 || ($key / $this->array->getSize()) >= 1 ) {
            $this->resize();
        }

        $this->array[$key] = $value;

        if ($key > $this->size) {
            $this->size = ($key + 1);
        }
    }

    public function add(mixed $value): void
    {
        if ($this->size == $this->array->getSize()) {
            $this->resize();
        }

        $this->array[$this->size] = $value;
        $this->size++;
    }

    public function remove(int $index): void
    {
        unset($this->array[$index]);
        $this->size--;
    }

    public function clear()
    {
        $this->array = new SplFixedArray($this->getSize());
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getArray(): SplFixedArray
    {
        return $this->array;
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
}