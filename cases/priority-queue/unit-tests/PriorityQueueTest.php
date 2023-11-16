<?php

namespace UnitTests;

include(__DIR__ . '/../PriorityQueue.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\PriorityQueue;

class PriorityQueueTest extends TestCase
{
    private PriorityQueue $priorityQueue;

    protected function setUp(): void
    {
        $this->priorityQueue = new PriorityQueue();
    }

    public function testAdd(): void
    {
        $this->priorityQueue->add('Item 1', 1);
        $this->priorityQueue->add('Item 2', 2);

        $this->assertEquals('Item 2', $this->priorityQueue->peek());
    }

    public function testPeek(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Queue is empty');

        $this->priorityQueue->peek();
    }

    public function testPoll(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Queue is empty');

        $this->priorityQueue->poll();
    }

    public function testInsert(): void
    {
        $this->priorityQueue->insert('Item 1', 1);
        $this->priorityQueue->insert('Item 2', 2);

        $this->assertEquals('Item 2', $this->priorityQueue->peek());
    }

    public function testFindMin(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Queue is empty');

        $this->priorityQueue->findMin();
    }

    public function testDeleteMin(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Queue is empty');

        $this->priorityQueue->deleteMin();
    }

    public function testWithJSONData(): void
    {
        $jsonContents = file_get_contents(__DIR__ . '/../../../assets/json/dataset_sorteren.json');
        if (json_decode($jsonContents)) {
            $jsonContents = json_decode($jsonContents);
        }

        if (is_object($jsonContents)) {
            foreach ($jsonContents as $testData) {
                $priorityQueue = new PriorityQueue();
                $peekData = [];

                // This index in the loop is the position of the value in the DoublyLinkedList.
                // It is not set in the file so it will automaticly be the same as from the doubly linked list.
                foreach ($testData as $value) {
                    $prio = intval(round(rand(0, 100)));
                    if (empty($peekData) || $peekData['priority'] <= $prio) {
                        $peekData = [
                            'data' => $value,
                            'priority' => $prio,
                        ];
                    }

                    $priorityQueue->add($value, $prio);
                    $this->assertEquals($peekData['data'], $priorityQueue->peek());
                }

                // Don't log to file because of infinite recursion in list.
            }
        }
    }
}