<?php
$name = $_REQUEST["name"] ?? '';
$email = $_REQUEST["email"] ?? '';
$feedback = $_REQUEST["feedback"] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displaying Feedback</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
    if (empty($name) && empty($email) && empty($feedback)) {
        printf("You did not input anything") ;
    } else {
        printf("Name: %s<br><br>", strtoupper($name));
        printf("Email: $email". "<br><br>");
        printf("Feedback: $feedback". "<br>");
    }
        
    ?>
</body>
</html>