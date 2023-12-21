<?php

include(__DIR__ . '/Benchmark.php');
include(__DIR__ . '/../cases/graph/Graph.php');
include(__DIR__ . '/../cases/dijkstra/Dijkstra.php');

use Cases\Graph;
use Cases\Vertex;
use Cases\Edge;

use function Cases\dijkstra;

// Amount of vertexes
$testingSize = 10000;
$graph = new Graph();

// Create vertexes
for ($i = 0; $i < $testingSize; $i++) {
    $vertex = new Vertex($i);

    $graph->addVertex($vertex);
}


Benchmark::start('Test dijkstra size 10000');
// dijkstra
$result = dijkstra($graph, 0, 9999);

Benchmark::end('Test dijkstra size 10000');

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

Benchmark::start('Dijkstra (at least one edge leaving from it)');
$result = dijkstra($graph, 0, 9999);
Benchmark::end('Dijkstra (at least one edge leaving from it)');

// reset
$graph = new Graph();
for ($i = 0; $i < $testingSize; $i++) {
    $vertex = new Vertex($i);

    $graph->addVertex($vertex);
}

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

Benchmark::start('Dijkstra (a least one edge coming to it)');
$result = dijkstra($graph, 0, 9999);
Benchmark::end('Dijkstra (a least one edge coming to it)');


// Dijkstra called random and 10000 time
// build random array of 10000 items with random vertexes
$randomVertexes = [];
for ($i = 0; $i < 1000; $i++) {
    $randomVertex1 = $graph->getVertex(rand(0, $testingSize - 1));
    $randomVertex2 = $graph->getVertex(rand(0, $testingSize - 1));
    
    $randomVertexes[] = [
        $randomVertex1->getName(),
        $randomVertex2->getName(),
    ];
}

Benchmark::start('Dijkstra (called random vertex 10000 times)');
for ($i = 0; $i < 1000; $i++) {
    $result = dijkstra($graph, $randomVertexes[$i][0], $randomVertexes[$i][1]);
}
Benchmark::end('Dijkstra (called random vertex 10000 times)');


echo PHP_EOL;
echo PHP_EOL;
print_r(Benchmark::getAll());
// echo $graph;
echo PHP_EOL;
echo PHP_EOL;
