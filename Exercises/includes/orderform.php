<?php
session_start();
//include 'productlisting.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <a href="shoppingcart.php">View Cart</a>
    <h1>Products</h1>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Size</th>
                <th>Price</th>
            </tr>
        </thead>
            <tr>

                <td><?php echo htmlspecialchars($index); ?></td>
                <td><?php echo htmlspecialchars($details['id']); ?></td>
                <td><?php echo htmlspecialchars($details['name']); ?></td>
                <td><?php echo htmlspecialchars($details['size']); ?></td>
                <td><?php echo '$' . number_format($details['price'], 2);?></td>
                 <td>
                    <form action="shoppingcart.php" method="post" class="form">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($details['id']); ?>">
                        <input type="number" name="qty" min="1" value="1">
                        <button type="submit" name="submit" value="Buy">Buy</button>
                    </form>
                </td>
            </tr>
            </tr>
        </tbody>

    </table>
</body>
</html>