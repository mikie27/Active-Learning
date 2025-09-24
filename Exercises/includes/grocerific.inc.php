<?php
require("checkID.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocerific ID Display</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <?php

    $product_id = $_REQUEST['product_id'];
    $product = getProductById($product_id);
    if ($product) {
        ?>
        <table  cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $product['id']; ?></td>
                    <td><?php echo $product['description']; ?></td>
                    <td><?php echo $product['size']; ?></td>
                    <td><?php echo " - $" . number_format($product['price'], 2);?></td>
                </tr>
            </tbody>
        </table>
        <?php 
    } else {
         ?>
         <table  cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo "Product not found."; ?></td>
                    <td><?php echo "N/A"; ?></td>
                    <td><?php echo "N/A"; ?></td>
                    <td><?php echo "N/A"; ?></td>
                </tr>
            </tbody>
        </table><?php
    }
    ?>
</body>
</html>