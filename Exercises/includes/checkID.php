<?php
session_start();
function getProducts() {
    $_SESSION['products'] = [
        ['id' => 10, 'description' => 'Coke Can',  'size' => '330ml', 'price' => 15],
        ['id' => 15, 'description' => 'Coke 8oz',  'size' => '237ml', 'price' => 24],
        ['id' => 22, 'description' => 'Coke 12oz', 'size' => '355ml', 'price' => 35],
    ];
    return $_SESSION['products'];
}

function getProductById($id){
    $products = getProducts();
    foreach ($products as $product) {
        if (isset($product['id']) && $product['id'] == $id) {
            return $product;
        }
    }
    return null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check ID</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <form action="grocerific.inc.php" method="get">
    <label for="product_id"><strong>Check product ID:</strong></label><br><br>
    <input type="text" name="product_id" class="inputfield">
    <button type="submit" class="button">Check</button>
</form>
</body>
</html>

</html>