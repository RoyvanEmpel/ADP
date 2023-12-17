<?php

use Cases\Edge;
use Cases\Graph;
use Cases\Vertex;

function importEdgeLine(Graph &$graph, array $lijnlijst): void
{
    foreach ($lijnlijst as $edge) {
        if (count($edge) === 3) {
            [$node1, $node2, $cost] = $edge;
        } else {
            [$node1, $node2] = $edge;
        }

        if (!isset($cost)) {
            $cost = 1;
        }

        if (($vertex1 = $graph->getVertex($node1)) === null) {
            $vertex1 = new Vertex($node1);
            $graph->addVertex($vertex1);
        }

        if (($vertex2 = $graph->getVertex($node2)) === null) {
            $vertex2 = new Vertex($node2);
            $graph->addVertex($vertex2);
        }
        
        $edge1 = new Edge($vertex2, $cost);
        $vertex1->addEdge($edge1);
    }
}

function importAdjacencyList(Graph $graph, array $adjacentielijst): void
{
    foreach ($adjacentielijst as $node => $adjacentNodes) {
        // Create vertex 1 if it doesn't exist yet
        if (($vertex1 = $graph->getVertex($node)) === null) {
            $vertex1 = new Vertex($node);
            $graph->addVertex($vertex1);
        }

        foreach ($adjacentNodes as $adjacentNode) {
            $cost = 1;
            
            if (is_array($adjacentNode)) {
                [$adjacentNode, $cost] = $adjacentNode;
            }

            $vertex2 = null;

            // Create vertex 2 if it doesn't exist yet
            if (($vertex2 = $graph->getVertex($adjacentNode)) === null) {
                $vertex2 = new Vertex($adjacentNode);
                $graph->addVertex($vertex2);
            }

            $edge1 = new Edge($vertex2, $cost);
            $vertex1->addEdge($edge1);
        }
    }
}

function importAdjacencyMatrix(Graph $graph, array $adjacentiematrix): void
{
    foreach ($adjacentiematrix as $node => $adjacentNodes) {
        // Create vertex 1 if it doesn't exist yet
        if (($vertex1 = $graph->getVertex($node)) === null) {
            $vertex1 = new Vertex($node);
            $graph->addVertex($vertex1);
        }

        foreach ($adjacentNodes as $adjacentNode => $cost) {
            if ($cost === 0) {
                continue;
            }

            $vertex2 = null;

            // Create vertex 2 if it doesn't exist yet
            if (($vertex2 = $graph->getVertex($adjacentNode)) === null) {
                $vertex2 = new Vertex($adjacentNode);
                $graph->addVertex($vertex2);
            }

            $edge1 = new Edge($vertex2, $cost);
            $vertex1->addEdge($edge1);
        }
    }
}