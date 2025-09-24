<?php
session_start();
//require 'checkID.php';
$cart = $_SESSION['products'] ?? []; 
$quantity = $_REQUEST['qty'] ?? 0; 
$orderTotal = $quantity * 16;
$tax= $orderTotal * 0.12;
$delivery = 100;
$grandtotal = $orderTotal + $tax + $delivery;


if (isset($_POST['qty']))  {
    $id = $_POST['id'];
    $qty = (int)($_POST['qty'] ?? 0);

    if($qty > 0) {
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }
        if (isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] += $qty;
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
    if(!empty($_SESSION['cart'])) { ?> 
    <table cellpadding="10">
        <h1>Here are the contents of your shopping cart:</h1>
        <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Description</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $id => $qty){
                        // Prefer an item-specific quantity if present, otherwise fall back to the request qty
                        $qty = isset($item['qty']) ? (int) $item['qty'] : (int)($_REQUEST['qty'] ?? 0);
                        if (!isset($products [$id])); continue; // show only items that have quantity

                        $item = $products[$id];
                        $orderTotal = $item['price'] * $qty;
                        $tax= $orderTotal * 0.12;
                        $delivery = 100;
                        $grandtotal = $orderTotal + $tax + $delivery;
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($item['description'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($item['size'] ?? ''); ?></td>
                        <td><?php echo '$' . number_format($item['price'] ?? 0, 2); ?></td>
                        <td><?php echo $qty; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table> <?php
            if ($orderTotal > $delivery){
                echo "You qualify for free delivery!<br><br>";
                $delivery=0;
            }else {
                echo "You do not qualify for free delivery!<br><br>";
                
            }
                printf("Order Total:" . number_format($orderTotal, decimals: 2) . "<br>");
                printf("Tax:" . number_format($tax, 2) . "<br>");
                printf("Delivery:" . number_format($delivery, 2) . "<br>");
                printf("Grand Total:" . number_format($grandtotal, 2) . "<br><br>");
            
                ?> <a href="feedback.php">Submit Feedback</a><?php
            } 
        }
    else{
        echo "You did not order anything.";
        exit();
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
   
</body>
</html>