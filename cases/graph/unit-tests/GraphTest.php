<?php

namespace UnitTests;

include(__DIR__ . '/../Graph.php');

use PHPUnit\Framework\TestCase;
use Cases\Graph;
use Cases\Vertex;
use Cases\Edge;

class GraphTest extends TestCase
{
    private Graph $graph;
    private array $dataset;

    protected function setUp(): void
    {
        $this->graph = new Graph();
        
        $dataset = file_get_contents(__DIR__ . '/../../../assets/json/dataset_grafen.json');
        $this->dataset = json_decode($dataset, true);
    }

    /**
     * Importer tests for Edge Line and Edge Line Weighted
     */

    public function testImportEdgeLine(): void
    {
        $this->importEdgeLine($this->dataset['lijnlijst']);

        echo PHP_EOL;
        echo "EdgeLine: " . PHP_EOL;
        echo $this->graph;
        echo PHP_EOL;
        echo PHP_EOL;

        $this->assertTrue(true);
    }

    public function testImportEdgeLineWeighted(): void
    {
        $this->importEdgeLine($this->dataset['lijnlijst_gewogen']);

        echo PHP_EOL;
        echo "EdgeLine Weighted: " . PHP_EOL;
        echo $this->graph;
        echo PHP_EOL;
        echo PHP_EOL;

        $this->assertTrue(true);
    }

    private function importEdgeLine(array $edgeList): void
    {
        foreach ($edgeList as $edge) {
            if (count($edge) === 3) {
                [$node1, $node2, $cost] = $edge;
            } else {
                [$node1, $node2] = $edge;
            }

            if (!isset($cost)) {
                $cost = 1;
            }

            if (($vertex1 = $this->graph->getVertex($node1)) === null) {
                $vertex1 = new Vertex($node1);
                $this->graph->addVertex($vertex1);
            }

            if (($vertex2 = $this->graph->getVertex($node2)) === null) {
                $vertex2 = new Vertex($node2);
                $this->graph->addVertex($vertex2);
            }
            
            $edge1 = new Edge($vertex2, $cost);
            $vertex1->addEdge($edge1);
        }
    }

    /**
     * Importer tests for Adjacency List and Adjacency List Weighted
     */

    public function testImportAdjacencyList(): void
    {
        $this->importAdjacencyList($this->dataset['verbindingslijst']);

        echo PHP_EOL;
        echo "Adjacency List: " . PHP_EOL;
        echo $this->graph;
        echo PHP_EOL;
        echo PHP_EOL;

        $this->assertTrue(true);
    }

    public function testImportAdjacencyListWeighted(): void
    {
        $this->importAdjacencyList($this->dataset['verbindingslijst_gewogen']);

        echo PHP_EOL;
        echo "Adjacency List Weighted: " . PHP_EOL;
        echo $this->graph;
        echo PHP_EOL;
        echo PHP_EOL;

        $this->assertTrue(true);
    }

    private function importAdjacencyList(array $adjacentielijst): void
    {
        foreach ($adjacentielijst as $node => $adjacentNodes) {
            if (($vertex1 = $this->graph->getVertex($node)) === null) {
                $vertex1 = new Vertex($node);
                $this->graph->addVertex($vertex1);
            }

            foreach ($adjacentNodes as $adjacentNode) {
                $cost = 1;
                
                if (is_array($adjacentNode)) {
                    [$adjacentNode, $cost] = $adjacentNode;
                }

                $vertex2 = null;

                if (($vertex2 = $this->graph->getVertex($adjacentNode)) === null) {
                    $vertex2 = new Vertex($adjacentNode);
                    $this->graph->addVertex($vertex2);
                }

                $edge1 = new Edge($vertex2, $cost);
                $vertex1->addEdge($edge1);
            }
        }
    }
}