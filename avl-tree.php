<?php

require_once __DIR__ . '/cases/avltree/AVLTree.php';

$avl = new AVLTree();
$keys = [50, 25, 75, 15, 35, 60, 120, 10, 68, 90, 125, 83, 100];

foreach ($keys as $key) {
    $avl->insert($key);
}

$json = json_encode($avl->toJSON());

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
        <div id="hidden-values">
            <?php foreach ($keys as $value) { ?>
                <input type="hidden" name="avlTree[]" value="<?= $value ?>">
            <?php } ?>
        </div>

        <div class="d-flex flex-column p-4" style="max-width: 300px;">
            <div class="input-group mb-3">
                <input id="insert-number" type="number" class="form-control" placeholder="Insert number">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="insertValue()">Insert</button>
                </div>
            </div>

            <div class="input-group mb-3">
                <input id="delete-number" type="number" class="form-control" placeholder="Delete number">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" onclick="deleteValue()">Delete</button>
                </div>
            </div>
        </div>


        <div id="tree-container"></div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            var AVLTreeConfig = {
                chart: {
                    container: "#tree-container"
                },
                
                nodeStructure: <?= $json ?>
            };
            var AVLTree = new Treant(AVLTreeConfig);
            
            function insertValue() {
                var value = parseInt(document.getElementById('insert-number').value);

                if (typeof value == 'number') {
                    var hiddenContainer = document.getElementById('hidden-values');
                    var input = document.createElement('input');
                    input.type = 'hidden';  
                    input.name = 'avlTree[]';
                    input.value = value;
                    hiddenContainer.appendChild(input);

                    var hiddenValues = hiddenContainer.querySelectorAll('input');
                    var values = [];
                    for (var i = 0; i < hiddenValues.length; i++) {
                        values.push(parseInt(hiddenValues[i].value));
                    }

                    updateData(values, input);
                }
            }

            function deleteValue() {
                var value = parseInt(document.getElementById('delete-number').value);
                if (typeof value == 'number') {
                    // remove the value from the hidden container
                    var hiddenContainer = document.getElementById('hidden-values');
                    var hiddenValues = hiddenContainer.querySelectorAll('input');
                    var values = [];

                    var input;
                    for (var i = 0; i < hiddenValues.length; i++) {
                        if (parseInt(hiddenValues[i].value) != value) {
                            values.push(parseInt(hiddenValues[i].value));
                        } else {
                            input = hiddenValues[i];
                        }
                    }

                    updateData(values, input, 'delete');
                }
            }

            function updateData(values, input, method = 'insert')
            {
                fetch('/avl-ajax.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        values: JSON.stringify(values)
                    })
                }).then(function(response) {
                    return response.json();
                }).then(function(data) {
                    if (data.error) {
                        alert(data.error);
                        input.remove();
                        return;
                    }

                    if (method == 'delete') {
                        input.remove();
                    }

                    AVLTreeConfig.nodeStructure = data;

                    AVLTree = new Treant(AVLTreeConfig);
                });
            }
        </script>
    </body>
</html>