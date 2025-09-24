
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Customer Feedback</h1>
    <form action="displayfeedback.php" id="form"method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" ><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" ><br>
        <label for="feedback">Feedback:</label><br>
        <textarea id="feedback" name="feedback" rows="4" ></textarea><br>
        <input type="submit" value="Submit Feedback">
    </form>
</body>
</html>

