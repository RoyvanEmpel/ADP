<?php

namespace Cases;

function dijkstra(Graph &$graph, string $startVertexName): array
{
    $distances = [];
    $previous = [];
    $queue = [];

    foreach ($graph->getVertices() as $vertexName => $vertex) {
        $distances[$vertexName] = INF;
        $previous[$vertexName] = null;
        $queue[$vertexName] = $distances[$vertexName];
    }

    if (!array_key_exists($startVertexName, $distances)) {
        throw new \InvalidArgumentException('Het startknooppunt bestaat niet in de graaf.');
    }

    $distances[$startVertexName] = 0;
    $queue[$startVertexName] = 0;

    while (!empty($queue)) {
        $currentVertexName = array_search(min($queue), $queue, true);
        unset($queue[$currentVertexName]);

        foreach ($graph->getVertex($currentVertexName)->getAdjacentEdges() as $edge) {
            $neighborName = $edge->getDestination()->getName();
            $alt = $distances[$currentVertexName] + $edge->getCost();

            if ($alt < $distances[$neighborName]) {
                $distances[$neighborName] = $alt;
                $previous[$neighborName] = $currentVertexName;
                $queue[$neighborName] = $alt;
            }
        }
    }

    return $distances;
}
