<?php

namespace UnitTests;

include(__DIR__ . '/../AVLTree.php');

use PHPUnit\Framework\TestCase;

use Cases\AVLTree;

class AVLTreeTest extends TestCase
{
    private $avlTree;

    protected function setUp(): void
    {
        $this->avlTree = new AVLTree();
    }

    public function testNewTreeIsEmpty()
    {
        $this->assertNull($this->avlTree->root);
    }

    public function testInsert()
    {
        $this->avlTree->insert(10);
        $this->assertEquals(10, $this->avlTree->root->key);

        $this->avlTree->insert(20);
        $this->avlTree->insert(30); // Causes rotation
        $this->assertEquals(20, $this->avlTree->root->key);
        $this->assertEquals(10, $this->avlTree->root->left->key);
        $this->assertEquals(30, $this->avlTree->root->right->key);
    }

    public function testDelete()
    {
        $this->avlTree->insert(10);
        $this->avlTree->insert(20);
        $this->avlTree->insert(30);
        $this->avlTree->delete(20);

        $this->assertEquals(30, $this->avlTree->root->key);
        $this->assertEquals(10, $this->avlTree->root->left->key);
        $this->assertNull($this->avlTree->root->right);
    }

    public function testSearch()
    {
        $this->avlTree->insert(10);
        $this->avlTree->insert(20);

        $foundNode = $this->avlTree->search(20);
        $this->assertNotNull($foundNode);
        $this->assertEquals(20, $foundNode->key);

        $notFoundNode = $this->avlTree->search(40);
        $this->assertNull($notFoundNode);
    }

    public function testGetHeight()
    {
        $this->avlTree->insert(10);
        $this->avlTree->insert(20);
        $this->assertEquals(2, $this->avlTree->getHeight($this->avlTree->root));
    }

    public function testGetBalanceFactor()
    {
        $this->avlTree->insert(10);
        $this->avlTree->insert(20);
        $this->avlTree->insert(30);

        $this->assertEquals(0, $this->avlTree->getBalanceFactor($this->avlTree->root));
    }

    public function testGetMinNode()
    {
        $this->avlTree->insert(30);
        $this->avlTree->insert(20);
        $this->avlTree->insert(10);

        $minNode = $this->avlTree->getMinNode($this->avlTree->root);
        $this->assertEquals(10, $minNode->key);
    }

    public function testtoArray()
    {
        $this->avlTree->insert(10);
        $this->avlTree->insert(20);
        $json = $this->avlTree->toArray();

        $expectedJSON = [
            'text' => ['name' => 10],
            'children' => [
                ['text' => ['name' => 20], 'children' => []]
            ]
        ];

        $this->assertEquals($expectedJSON, $json);
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $key => $testData) {
                foreach ($testData as $value) {
                    try {
                        $this->avlTree->insert($value);
                    } catch (\Throwable $th) {
                        // Nothing to do...
                    }
                }

                $this->assertNotEmpty($this->avlTree->toArray());
            }
        }
    }
}