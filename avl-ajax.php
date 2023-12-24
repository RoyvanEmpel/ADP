<?php

require_once __DIR__ . '/cases/avltree/AVLTree.php';

use Cases\AVLTree;

try {
    $avl = new AVLTree();
    $keys = json_decode($_POST['values']);

    foreach ($keys as $key) {
        $avl->insert($key);
    }

    $json = json_encode($avl->toArray());
    echo $json;
} catch (\Throwable $th) {
    echo json_encode(['error' => $th->getMessage()]);
}