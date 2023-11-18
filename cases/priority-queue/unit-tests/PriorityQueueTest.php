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
            foreach ($jsonContents as $loop => $testData) {
                $priorityQueue = new PriorityQueue();
                $peekData = [];

                foreach ($testData as $value) {
                    // echo PHP_EOL;
                    // echo "---------------------- $index ----------------------";
                    // echo PHP_EOL;
                    $prio = rand(0, 100);

                    if (empty($peekData) || ($peekData['priority'] <= $prio)) {
                        $peekData = [
                            'data' => $value,
                            'priority' => $prio
                        ];
                    // } else {
                        // echo "peekData niet hoger: " . $peekData['priority'] . " - " . $prio . " - " . $peekData['data'] . " - " . $value;
                        // echo PHP_EOL;
                    }

                    $priorityQueue->add($value, $prio);

                    // print_r($priorityQueue->peekA());
                    // print_r($peekData);
                    // echo PHP_EOL;
                    // echo PHP_EOL;
                    // print_r($peekData['data'] . ' - ' . $priorityQueue->peek());

                    // if ($peekData !== $priorityQueue->peek2()) {
                    //     echo PHP_EOL;
                    //     echo "fout!";
                    //     echo PHP_EOL;
                    //     print_r($peekData);
                    //     print_r($priorityQueue->peek2());
                    //     echo PHP_EOL;
                    //     die;
                    // } else {
                    //     echo PHP_EOL;
                    //     // print_r($peekData);
                    // }

                    $this->assertEquals($peekData, $priorityQueue->peek2());
                }

                // echo PHP_EOL;
                // echo "==================================";
                // echo PHP_EOL;
                // if ($loop == 'lijst_float_8001') {
                //     die;
                // }

                // Don't log to file because of infinite recursion in list.
            }
        }
    }
}