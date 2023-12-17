<?php

namespace Cases;

class Edge
{
    private Vertex $destination;
    private float $cost;

    public function __construct(Vertex $destination, float $cost)
    {
        $this->destination = $destination;
        $this->cost = $cost;
    }

    public function getDestination(): Vertex
    {
        return $this->destination;
    }

    public function getCost(): float
    {
        return $this->cost;
    }
}
