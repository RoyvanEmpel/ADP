<?php

namespace Cases;

include(__DIR__ . '/../../cases/doubly-linked-list/DoublyLinkedList.php');

use Cases\DoublyLinkedList;
use PHPUnit\Event\Runtime\PHP;

class PriorityQueue
{
    private DoublyLinkedList $list;

    public function __construct()
    {
        $this->list = new DoublyLinkedList();
    }

    public function add(mixed $data, int $priority): void
    {
        $this->list->start();

        $item = [
            'data' => $data,
            'priority' => $priority,
        ];

        echo "inserting $priority \n";

        /**
         * Tijdelijk even een paar comments voor mezelf.
         * 
         * We gebruiken de while omdat we de lijst doorlopen en de *Laatste* dichtsbijzijnde prioriteit willen vinden.
         * Dus al we 10x 100 hebben, willen we de laatste 100 hebben.
         * 
         * Als de lijst leeg is, voeg toe aan het begin
         * 
         * Ga door de lijst vanaf het begin en vind de dichtsbijzijnde prioriteit. Voeg niet toe, maar houd de node bij
         * 
         * Als er geen node is gevonden, voeg toe aan het begin
         * 
         * Als er een node is gevonden, voeg toe na die node
         */

        // if $this->list is empty, add to the start
        if ($this->list->current() === null) {
            $this->list->append($item);
            echo "inserted first \n";
            return;
        }

        // go through the list from the start and find the closest priority. Do not insert, but keep track of the node
        $closestNode = null;
        while ($this->list->current() !== null) {
            $currentPriority = $this->list->current()['priority'];
            if ($currentPriority <= $priority) {
                $closestNode = $this->list->current();
            }

            $this->list->next();
        }

        // if no node was found, add to the start
        if ($closestNode === null) {
            $this->list->prepend($item);
            echo "inserted start \n";
            return;
        }

        // if a node was found, insert after that node
        $this->list->insertAfter($closestNode, $item);
        echo "inserted after " . $closestNode['priority'] . " \n";
    }

    public function peek(): mixed
    {
        if ($this->list->end() === null) {
            throw new \Exception('Queue is empty');
        }

        return $this->list->end()['data'] ?? null;
    }

    public function peek2(): mixed
    {
        if ($this->list->end() === null) {
            throw new \Exception('Queue is empty');
        }

        return $this->list->end();
    }

    public function toArray(bool $simple = true): mixed
    {
        return $this->list->toArray($simple);
    }

    public function poll(): mixed
    {
        if ($this->list->start() === null) {
            throw new \Exception('Queue is empty');
        }

        $data = $this->list->start()['data'];
        $this->list->shift();

        return $data;
    }

    public function insert(mixed $data, int $priority): void
    {
        $this->add($data, $priority);
    }

    public function findMin(): mixed
    {
        $this->list->start();

        if ($this->list->current() === null) {
            throw new \Exception('Queue is empty');
        }

        return $this->list->current()['data'];
    }

    public function deleteMin(): void
    {
        $this->list->start();

        if ($this->list->current() === null) {
            throw new \Exception('Queue is empty');
        }

        $this->list->shift();
    }
}

// $list = new PriorityQueue();

// $list->add('aapje', 100);
// $list->add('aapje2', 50);
// $list->add('aapje3', 25);
// $list->add('aapje4', 75);
// $list->add('aapje5', 100);
// $list->add('aapje8', 75);
// $list->add('aapje6', 100);
// $list->add('aapje7', 100);
// $list->add('aapje9', 75);

// print_r($list->toArray(true));