<?php

namespace Cases;

use SplFixedArray;

class Hashtable
{
  private SplFixedArray $hashtable;

  public function __construct(int $arrayLength)
  {
    $this->hashtable = new SplFixedArray($arrayLength);
  }

  public function insert(string $key, mixed $value): void
  {
    $index = $this->hash($key);

    while (!empty($this->hashtable[$index])) {
      if ($this->hashtable[$index]['key'] == $key) {
        throw new \RuntimeException('Key already exists');
      }

      if ($index == $this->hashtable->getSize() - 1) {
        $index = 0;
      } else {
        $index++;
      }
    }

    $this->hashtable[$index] = [
      'key' => $key,
      'hash' => $this->hash($key),
      'value' => $value
    ];
  }

  public function get(string $key): mixed
  {
    $index = $this->searchIndex($key);

    return $this->hashtable[$index]['value'];
  }

  public function delete(string $key): bool
  {
    $index = $this->searchIndex($key);

    unset($this->hashtable[$index]);

    return true;
  }

  public function update(string $key, mixed $nextValue): void
  {
    $index = $this->searchIndex($key);

    $temp = $this->hashtable[$index];

    $temp['value'] = $nextValue;

    $this->hashtable[$index] = $temp;
  }

  private function hash(string $key): int
  {
    $hash = 0;
    $keyLength = strlen($key);

    for ($i = 0; $i < $keyLength; $i++) {
      $hash += ord($key[$i]);
    }

    return $hash % $this->hashtable->getSize();
  }

  private function searchIndex(string $key): ?int
  {
    $index = $this->hash($key);
    $startIndex = $index;

    while (!isset($this->hashtable[$index]['key']) || $this->hashtable[$index]['key'] != $key) {
      if ($index == $this->hashtable->getSize() - 1) {
        $index = 0;
      } else {
        $index++;
      }

      if ($index == $startIndex) {
        throw new \RuntimeException('Key not found: ' . $key);
      }
    }

    return $index;
  }
}
