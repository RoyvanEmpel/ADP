<?php

include(__DIR__ . '/cases/graph/Graph.php');
include(__DIR__ . '/helpers/helpers.php');

use Cases\Graph;

$lists = [];

$dataset = file_get_contents(__DIR__ . '/assets/json/dataset_grafen.json');
$dataset = json_decode($dataset, true);

// LijnLijst
$edgeList = new Graph();
importEdgeLine($edgeList, $dataset['lijnlijst']);
$lists['edgeList'] = $edgeList->toArray();

$edgeListWeigted = new Graph();
importEdgeLine($edgeListWeigted, $dataset['lijnlijst_gewogen']);
$lists['edgeListWeigted'] = $edgeListWeigted->toArray();
// End lijnlijst gewogen

// Verbindingslijst
$adjacencyList = new Graph();
importAdjacencyList($adjacencyList, $dataset['verbindingslijst']);
$lists['adjacencyList'] = $adjacencyList->toArray();

$adjacencyListWeigted = new Graph();
importAdjacencyList($adjacencyListWeigted, $dataset['verbindingslijst_gewogen']);
$lists['adjacencyListWeigted'] = $adjacencyListWeigted->toArray();
// End verbindingslijst


// Verbindingsmatrix
$adjacencyMatrix = new Graph();
importAdjacencyMatrix($adjacencyMatrix, $dataset['verbindingsmatrix']);
$lists['adjacencyMatrix'] = $adjacencyMatrix->toArray();

$adjacencyMatrixWeigted = new Graph();
importAdjacencyMatrix($edgeListWeigted, $dataset['verbindingsmatrix_gewogen']);
$lists['adjacencyMatrixWeigted'] = $edgeListWeigted->toArray();
// End verbindingsmatrix
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Grafiek met PHP-objecten</title>
    <style>
        canvas {
            border: 1px solid #000;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <div class="row w-100 p-4 text-center g-4">
        <?php foreach ($lists as $key => $noUse) { ?>
            <div class="col-md-4">
                <h2><?= ucfirst($key) ?></h2>
                <canvas id="<?= $key ?>" width="500" height="300"></canvas>
            </div>
        <?php } ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($lists as $key => $graph) { ?>
                var canvas = document.getElementById('<?= $key ?>');
                var context = canvas.getContext('2d');

                var nodes = <?= json_encode($graph) ?>;

                var gridSize = 60; // Afstand tussen cirkels

                // Teken bolletjes met labels op willekeurige posities zonder overlap
                nodes.forEach(function(node) {
                    var x, y;
                    do {
                        x = Math.floor(Math.random() * (canvas.width - gridSize)) + gridSize / 2;
                        y = Math.floor(Math.random() * (canvas.height - gridSize)) + gridSize / 2;
                    } while (isPositionOccupied(nodes, x, y));

                    context.beginPath();
                    context.arc(x, y, 20, 0, 2 * Math.PI);
                    context.fillStyle = 'blue';
                    context.fill();
                    context.stroke();
                    context.fillStyle = 'white';
                    context.font = '12px Arial';
                    context.fillText(node.name, x - 5, y + 4);
                    node.x = x;
                    node.y = y;
                });

                // Teken lijnen tussen knooppunten met pijlen en toon de kosten
                nodes.forEach(function(node) {
                    var edges = node.adjacentEdges;
                    edges.forEach(function(edge) {
                        var destinationNode = nodes.find(function(n) {
                            return n.name === edge.destination;
                        });

                        var arrowSize = 10;
                        var angle = Math.atan2(destinationNode.y - node.y, destinationNode.x - node.x);
                        var textX = (node.x + destinationNode.x) / 2;
                        var textY = (node.y + destinationNode.y) / 2;

                        context.beginPath();
                        context.moveTo(node.x + 20 * Math.cos(angle), node.y + 20 * Math.sin(angle));
                        context.lineTo(destinationNode.x - 20 * Math.cos(angle), destinationNode.y - 20 * Math.sin(angle));

                        // Pijlpunt tekenen
                        context.lineTo(
                            destinationNode.x - (20 + arrowSize) * Math.cos(angle - Math.PI / 10),
                            destinationNode.y - (20 + arrowSize) * Math.sin(angle - Math.PI / 10)
                        );
                        context.moveTo(destinationNode.x - 20 * Math.cos(angle), destinationNode.y - 20 * Math.sin(angle));
                        context.lineTo(
                            destinationNode.x - (20 + arrowSize) * Math.cos(angle + Math.PI / 10),
                            destinationNode.y - (20 + arrowSize) * Math.sin(angle + Math.PI / 10)
                        );

                        // Tekst met kostprijs
                        context.fillStyle = 'black';
                        context.font = '12px Arial';
                        if (edge.cost > 1) {
                            context.fillText(edge.cost, textX, textY);
                        }

                        context.strokeStyle = 'black';
                        context.stroke();
                    });
                });

                // Functie om te controleren of een positie al bezet is
                function isPositionOccupied(nodes, x, y) {
                    return nodes.some(function(node) {
                        return Math.abs(node.x - x) < gridSize && Math.abs(node.y - y) < gridSize;
                    });
                }
            <?php } ?>
        });
    </script>

</body>

</html>