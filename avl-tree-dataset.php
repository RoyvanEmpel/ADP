<?php

require_once __DIR__ . '/cases/avltree/AVLTree.php';

use Cases\AVLTree;

// Setup trees from data_sorteren.json
$jsonData = json_decode(file_get_contents(__DIR__ . '/assets/json/dataset_sorteren.json'), true);

// $jsonKeys = array_keys($jsonData);
// foreach ($jsonData as $key => $items) {
//     $$key = new AVLTree();
    
//     foreach ($items as $value) {
//         try {
//             $$key->insert($value);
//         } catch (\Throwable $th) {
//             // Nothing to do...
//         }
//     }
// }
?>


<!DOCTYPE html>
<html>
    <head>
        <title>AVL Tree Visualization</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel='stylesheet' href='./assets/css/treant.css'>

        <script src='./assets/js/jquery.min.js'></script>
        <script src='./assets/js/raphael.js'></script>
        <script src='./assets/js/treant.js'></script>
    </head>
    <body>
        <div class="row">
            <?php foreach ($jsonData as $key => $values) {?>
                <div class="col-12 text-center">
                    <h3><?= $key ?></h3>
                    <div id="tree-container-<?= $key ?>"></div>
                    <script>

                        $(() => {
                            $.ajax({
                                url: '/avl-ajax-dataset.php',
                                method: 'GET',
                                data: {
                                    key: '<?= $key ?>'
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data !== null) {
                                        console.log('<?= $key ?>', data);
                                        var AVLTreeConfig = {
                                            chart: {
                                                container: "#tree-container-<?= $key ?>",
                                            },
                                            
                                            nodeStructure: data
                                        };
                                        var AVLTree = new Treant(AVLTreeConfig);
                                    }

                                }
                            });
                        });

                    </script>
                </div>
            <?php } ?>
        </div>

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>