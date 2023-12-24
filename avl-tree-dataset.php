<?php

use Cases\AVLTree;

require_once __DIR__ . '/cases/avltree/AVLTree.php';

// Setup trees from data_sorteren.json
$jsonData = json_decode(file_get_contents(__DIR__ . '/assets/json/dataset_sorteren.json'), true);


$jsonValues = [];
foreach ($jsonData as $key => $data) {
    $$key = new AVLTree();

    foreach ($data as $value) {
        try {
            $$key->insert($value);
        } catch (\Throwable $th) {
            // Nothing to do...
        }
    }

    $jsonValues[$key] = json_encode($$key->toArray());
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>AVL Tree Visualization</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel='stylesheet' href='./assets/css/treant.css'>

        <script src='./assets/js/jquery.min.js'></script>
        <link rel="stylesheet" href="./assets/css/treeflex.css">
    </head>
    <body>
        <div class="row">
            <?php foreach ($jsonValues as $key => $values) {?>
                <div class="col-12 text-center">

                    <h3><?= $key ?></h3>
                    <div id="tree-container-<?= $key ?>" class="tf-tree">
                        <ul></ul>
                    </div>
                    <script>

                        $(() => {
                            let tree = document.getElementById('tree-container-<?= $key ?>');
                            let myData = <?= $values ?>;
                            console.log(myData);
                            if (myData !== null) {
                                addNode(myData, tree);
                            }
                        });

                        function addNode(child, parent)
                        {
                            let li = document.createElement('li');
                            let span = document.createElement('span');

                            span.classList.add('tf-nc');
                            span.innerHTML = child.text.name;

                            li.appendChild(span);

                            if (child.children.length > 0) {
                                let ul = document.createElement('ul');
                                li.appendChild(ul);

                                for (let index = 0; index < child.children.length; index++) {
                                    const element = child.children[index];
                                    addNode(element, ul);
                                }
                            }

                            parent.appendChild(li);
                        }

                    </script>
                </div>
            <?php } ?>
        </div>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>