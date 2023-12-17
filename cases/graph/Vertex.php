<?php

namespace Cases;

class Vertex
{
    private string $name;
    private array $adjacentEdges;
    private float $distance;
    private ?Vertex $previous;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->adjacentEdges = [];

        $this->distance = INF;
        $this->previous = null;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAdjacentEdges(): array
    {
        return $this->adjacentEdges;
    }

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function getPrevious(): ?Vertex
    {
        return $this->previous;
    }

    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    public function setPrevious(?Vertex $previous): void
    {
        $this->previous = $previous;
    }

    public function addEdge(Edge $edge): void
    {
        $this->adjacentEdges[] = $edge;
    }
}
