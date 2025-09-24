<?php

$products = [
    [
        'name' => 'Coke Can',
        'size' => '330ml',
        'id'=> '10',
        'price' => 12
    ],
    [
        'name' => 'Coke 8oz',
        'size' => '237ml',
        'id'=> '15',
        'price' => 8
    ],
     [
        'name' => 'Coke 12oz',
        'size' => '355ml',
        'id'=> '22',
        'price' => 11
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <a href="shoppingcart.php">View Cart</a>
    <h1>Products</h1>
    <table>
        <thead>
            <tr>
                <th>Index</th>
                <th>Id</th>
                <th>Description</th>
                <th>Size</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
           
                foreach ($products as $index => $details) {
                    echo "<tr>";
                    echo "<td>{$index}</td>";
                    echo "<td>{$details['id']}</td>"; 
                    echo "<td>{$details['name']}</td>";         
                    echo "<td>{$details['size']}</td>";                  
                    echo "<td> $" . number_format($details['price'], 2) . "</td>";
                      echo '<td>
                   <form action="shoppingcart.php" method="post" class="notform">
                        <input type="hidden" name="id" value="' . htmlspecialchars($details['id'], ENT_QUOTES) . '">
                        <input type="number" name="qty" class="inputfield" placeholder="no of items" min="1" step="1" required>
                        <button type="submit" name="submit" class="button" value="Buy">Buy</button>
                   </form>
                </td>';
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>