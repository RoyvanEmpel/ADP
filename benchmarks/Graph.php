<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/graph/Graph.php');

use Cases\Graph;
use Cases\Vertex;
use Cases\Edge;

// Amount of vertexes
$testingSize = 10000;
$graph = new Graph();

Benchmark::start('Create vertexes');
// Create vertexes
for ($i = 0; $i < $testingSize; $i++) {
    $vertex = new Vertex($i);

    $graph->addVertex($vertex);
}
Benchmark::end('Create vertexes');

Benchmark::start('Create edges (at least one edge leaving from it)');
// Create edges
// Here give every vertex a least one leaving from it.
// This means that some vertexes will not have a edge going to it.
for ($i = 0; $i < $testingSize; $i++) {
    $vertex = $graph->getVertex($i);

    $edgeAmount = rand(1, 4);
    for ($j = 0; $j < $edgeAmount; $j++) {
        $randomVertex = $graph->getVertex(rand(0, $testingSize - 1));

        $cost = rand(1, $testingSize / 2);

        $edge = new Edge($randomVertex, $cost);

        $vertex->addEdge($edge);
    }
}
Benchmark::end('Create edges (at least one edge leaving from it)');

// reset
$graph = new Graph();
for ($i = 0; $i < $testingSize; $i++) {
    $vertex = new Vertex($i);

    $graph->addVertex($vertex);
}

Benchmark::start('Create edges (a least one edge coming to it)');
// Create edges
// Here give every vertex a least one coming to it.
// This means that some vertexes will not have a edge leaving from it.
// But all vertexes will have a edge coming to it.
for ($i = 0; $i < $testingSize; $i++) {
    $destinationVertex = $graph->getVertex($i);

    $edgeAmount = rand(1, 4);
    for ($j = 0; $j < $edgeAmount; $j++) {
        $randomVertex = $graph->getVertex(rand(0, $testingSize - 1));

        $cost = rand(1, $testingSize / 2);

        $edge = new Edge($destinationVertex, $cost);

        $randomVertex->addEdge($edge);
    }
}
Benchmark::end('Create edges (a least one edge coming to it)');

echo PHP_EOL;
echo PHP_EOL;
print_r(Benchmark::getAll());
// echo $graph;
echo PHP_EOL;
echo PHP_EOL;
