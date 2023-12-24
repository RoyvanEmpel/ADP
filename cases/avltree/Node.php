<?php

namespace Cases;

class Node
{
    public float $key;
    public ?Node $left;
    public ?Node $right;
    public int $height;

    public function __construct($key) {
        $this->key = $key;
        $this->left = null;
        $this->right = null;
        $this->height = 1;
    }
}