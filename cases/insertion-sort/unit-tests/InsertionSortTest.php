<?php

namespace UnitTests;

include(__DIR__ . '/../PriorityQueue.php');
include(__DIR__ . '/../../../Pasta.php');

use PHPUnit\Framework\TestCase;
use Cases\PriorityQueue;
use Pasta;
use PastaType;
use SauceType;

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

    public function testPastaPrio()
    {
        $pasta1 = new Pasta(PastaType::Spaghetti, SauceType::Tomatensaus);
        $pasta2 = new Pasta(PastaType::Fusilli, SauceType::Pesto);

        $this->priorityQueue->add($pasta1, 1); // prio 1
        $this->priorityQueue->add($pasta2, 1); // prio 1

        $this->priorityQueue->add($pasta1, 2); // prio 2
        $this->priorityQueue->add($pasta2, 2); // prio 2

        $this->assertEquals($pasta2, $this->priorityQueue->peek());
        $this->assertEquals($pasta1, $this->priorityQueue->poll());

        $pasta3 = new Pasta(PastaType::Spaghetti, SauceType::Pesto);
        $this->priorityQueue->add($pasta3, 0); // prio 0
        $this->assertEquals($pasta3, $this->priorityQueue->poll());

        $pasta4 = new Pasta(PastaType::Fusilli, SauceType::Tomatensaus);
        $this->priorityQueue->add($pasta4, 3); // prio 3
        $this->assertEquals($pasta4, $this->priorityQueue->peek());
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

                foreach ($testData as $value) {
                    $prio = rand(0, 100);

                    if (empty($peekData) || ($peekData['priority'] <= $prio)) {
                        $peekData = [
                            'data' => $value,
                            'priority' => $prio
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