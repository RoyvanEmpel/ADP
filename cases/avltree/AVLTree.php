<?php

namespace Cases;

use Exception;
use SplStack;

require_once 'Node.php';

class AVLTree
{
    public ?Node $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function getHeight($node) {
        return !$node ? 0 : $node->height;
    }

    public function getBalanceFactor($node) {
        return !$node ? 0 : ($this->getHeight($node->left) - $this->getHeight($node->right));
    }

    public function getMinNode($node) {
        return !$node || !$node->left ? $node : $this->getMinNode($node->left);
    }

    public function findMin()
    {
        if ($this->root === null) {
            throw new Exception("The tree is empty");
        }

        $current = $this->root;
        while ($current->left !== null) {
            $current = $current->left;
        }
        
        return $current->key;
    }

    public function findMax()
    {
        if ($this->root === null) {
            throw new Exception("The tree is empty");
        }

        $current = $this->root;
        while ($current->right !== null) {
            $current = $current->right;
        }
        
        return $current->key;
    }

    public function search($key) {
        $x = $this->root;
        while ($x !== null && $key != $x->key) {
            if ($key < $x->key) {
                $x = $x->left;
            } else {
                $x = $x->right;
            }
        }
        return $x;
    }

    public function insert($key) {
        $this->root = $this->insertNode($this->root, $key);
    }

    private function insertNode($root, $key) {
        if (!$root) {
            return new Node($key);
        }

        if ($key == $root->key) {
            throw new Exception("The node already exists");
        }

        if ($key < $root->key) {
            $root->left = $this->insertNode($root->left, $key);
        } else {
            $root->right = $this->insertNode($root->right, $key);
        }

        return $this->balanceNode($root);
    }

    public function delete($key) {
        $this->root = $this->deleteNode($this->root, $key);
    }

    private function deleteNode($root, $key) {
        if (!$root) {
            return $root;
        }

        if ($key < $root->key) {
            $root->left = $this->deleteNode($root->left, $key);
        } elseif ($key > $root->key) {
            $root->right = $this->deleteNode($root->right, $key);
        } else {
            if (!$root->left) {
                $temp = $root->right;
                $root = null;
                return $temp;
            } elseif (!$root->right) {
                $temp = $root->left;
                $root = null;
                return $temp;
            }

            $temp = $this->getMinNode($root->right);
            $root->key = $temp->key;
            $root->right = $this->deleteNode($root->right, $temp->key);
        }

        return $this->balanceNode($root);
    }

    private function balanceNode($root) {
        $root->height = 1 + max($this->getHeight($root->left), $this->getHeight($root->right));

        $bf = $this->getBalanceFactor($root);

        if ($bf > 1) {
            if ($this->getBalanceFactor($root->left) >= 0) {
                return $this->rightRotate($root);
            } else {
                $root->left = $this->leftRotate($root->left);
                return $this->rightRotate($root);
            }
        }

        if ($bf < -1) {
            if ($this->getBalanceFactor($root->right) <= 0) {
                return $this->leftRotate($root);
            } else {
                $root->right = $this->rightRotate($root->right);
                return $this->leftRotate($root);
            }
        }

        return $root;
    }

    public function leftRotate($node) {
        $B = $node->right;
        $Y = $B->left;

        $B->left = $node;
        $node->right = $Y;

        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        $B->height = 1 + max($this->getHeight($B->left), $this->getHeight($B->right));

        return $B;
    }

    public function rightRotate($node) {
        $A = $node->left;
        $Y = $A->right;

        $A->right = $node;
        $node->left = $Y;

        $node->height = 1 + max($this->getHeight($node->left), $this->getHeight($node->right));
        $A->height = 1 + max($this->getHeight($A->left), $this->getHeight($A->right));

        return $A;
    }


    public function toArray() {
        return $this->nodeToArray($this->root);
    }
    
    private function nodeToArray($node) {
        if ($node === null) {
            return null;
        }
    
        $result = [
            'text' => ['name' => $node->key],
            'children' => []
        ];
    
        if ($node->left !== null) {
            $result['children'][] = $this->nodeToArray($node->left);
        }
    
        if ($node->right !== null) {
            $result['children'][] = $this->nodeToArray($node->right);
        }
    
        return $result;
    }
    
}