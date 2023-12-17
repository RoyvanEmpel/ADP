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

    public function testImportEdgeLine(): void
    {
        $this->importEdgeLine($this->dataset['lijnlijst']);

        echo PHP_EOL;
        echo PHP_EOL;
        echo $this->graph;
        echo PHP_EOL;
        echo PHP_EOL;

        $this->assertTrue(true);
    }

    public function testImportEdgeLineWeighed(): void
    {
        $this->importEdgeLine($this->dataset['lijnlijst_gewogen']);

        echo PHP_EOL;
        echo PHP_EOL;
        echo $this->graph;
        echo PHP_EOL;
        echo PHP_EOL;

        $this->assertTrue(true);
    }

    private function importEdgeLine(array $lijnlijst): void
    {
        
        foreach ($lijnlijst as $edge) {
            list($node1, $node2, $cost) = $edge;

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
}