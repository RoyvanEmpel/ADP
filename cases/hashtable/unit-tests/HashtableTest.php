<?php

namespace UnitTests;

include(__DIR__ . '/../Hashtable.php');

use PHPUnit\Framework\TestCase;
use Cases\Hashtable;
use RuntimeException;

class HashtableTest extends TestCase
{
    // test get
    public function testGet()
    {
        $hashtable = new Hashtable(10);
        $hashtable->insert('key', 'value');
        $this->assertEquals('value', $hashtable->get('key'));
    }

    // test set
    public function testSet()
    {
        $hashtable = new Hashtable(10);
        $hashtable->insert('key', 'value');
        
        $this->expectException(RuntimeException::class);
        $hashtable->insert('key', 'value2');
    }

    // test remove
    public function testRemove()
    {
        $hashtable = new Hashtable(10);
        $hashtable->insert('key', 'value');
        $hashtable->delete('key');

        $this->expectException(RuntimeException::class);
        $this->assertEquals(null, $hashtable->get('key'));
    }

    
    // test get with multiple items
    public function testGetMultiple()
    {
        $hashtable = new Hashtable(10);
        $hashtable->insert('key', 'value');
        $hashtable->insert('key2', 'value2');
        $hashtable->insert('key3', 'value3');
        $this->assertEquals('value', $hashtable->get('key'));
        $this->assertEquals('value2', $hashtable->get('key2'));
        $this->assertEquals('value3', $hashtable->get('key3'));
    }

    // test get with collision items/same ascii value
    public function testGetCollision()
    {
        $hashtable = new Hashtable(10);
        $hashtable->insert('mia', 'value');
        $hashtable->insert('aim', 'value2');
        $hashtable->insert('sue', 'value3');
        $this->assertEquals('value', $hashtable->get('mia'));
        $this->assertEquals('value2', $hashtable->get('aim'));
        $this->assertEquals('value3', $hashtable->get('sue'));
    }

    // JSON files
    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_hashing.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $testData) {
                $testData = (array) $testData;
                $hashtable = new Hashtable(count($testData));

                foreach ($testData as $key => $value) {
                    $hashtable->insert((string)$key, $value);
                }
                
                foreach ($testData as $key => $value) {
                    $this->assertEquals($value, $hashtable->get($key));
                }
            }
        }
    }
}