<?php

require_once __DIR__ . '/cases/avltree/AVLTree.php';

use Cases\AVLTree;

// Setup trees from data_sorteren.json
$jsonData = json_decode(file_get_contents(__DIR__ . '/assets/json/dataset_sorteren.json'), true);

$avl = new AVLTree();

// enable php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($jsonData[$_GET['key']])) {
    echo json_encode([]);
    die;
}

foreach ($jsonData[$_GET['key']] as $value) {
    try {
        //code...
        $avl->insert($value);
    } catch (\Throwable $th) {
        //throw $th;
    }
}

echo json_encode($avl->toArray());