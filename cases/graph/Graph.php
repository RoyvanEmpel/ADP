<?php

namespace Cases;

require_once 'Vertex.php';
require_once 'Edge.php';

class Graph
{
    private array $vertexMap = [];

    public function addVertex(Vertex $vertex)
    {
        $this->vertexMap[$vertex->getName()] = $vertex;
    }

    public function getVertex(string $vertexName): ?Vertex
    {
        return $this->vertexMap[$vertexName] ?? null;
    }

    public function getVertices(): array
    {
        return $this->vertexMap;
    }

    public function getVertexCount(): int
    {
        return count($this->vertexMap);
    }

    public function getEdges(): array
    {
        $edges = [];

        foreach ($this->vertexMap as $vertex) {
            foreach ($vertex->getAdjacentEdges() as $edge) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    public function getEdgeCount(): int
    {
        return count($this->getEdges());
    }

    public function __toString(): string
    {
        $output = '';

        foreach ($this->vertexMap as $vertex) {
            $output .= $vertex->getName() . ' -> ';

            foreach ($vertex->getAdjacentEdges() as $edge) {
                $output .= $edge->getDestination()->getName() . '(' . $edge->getCost() .') ';
            }

            $output .= PHP_EOL;
        }

        return $output;
    }

    public function toArray(): array
    {
        $graphArray = [];

        foreach ($this->vertexMap as $vertex) {
            $vertexArray = [
                'name' => $vertex->getName(),
                'adjacentEdges' => []
            ];

            foreach ($vertex->getAdjacentEdges() as $edge) {
                $edgeArray = [
                    'destination' => $edge->getDestination()->getName(),
                    'cost' => $edge->getCost()
                ];

                $vertexArray['adjacentEdges'][] = $edgeArray;
            }

            $graphArray[] = $vertexArray;
        }

        return $graphArray;
    }
}
