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

Benchmark::start('Create edges');
// Create edges (random vertexes) every must have 1 edge going to it
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
Benchmark::end('Create edges');

echo PHP_EOL;
echo PHP_EOL;
print_r(Benchmark::getAll());
// echo $graph;
echo PHP_EOL;
echo PHP_EOL;
