<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grocerific Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="register.php" method="post">
        <h1>Register</h1>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" class="inputfield" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" class="inputfield" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" class="inputfield" required><br><br>
        <div>
            <span>Gender:</span><br>
            <input type="radio" id="role_customer" name="role" value="customer" checked>
            <label for="role_customer">Male</label><br>
            <input type="radio" id="role_admin" name="role" value="admin">
            <label for="role_admin">Female</label><br><br>
        </div>
        <label for="referral">How did you learn about us:</label><br>
        <select id="referral" name="referral" class="inputfield">
            <option value="friend">Friend or family</option>
            <option value="ad">Online advertisement</option>
            <option value="search">Search engine</option>
        </select><br><br>
        

         <label for="coupons">if you want to receive coupons from us, please select from the list:</label><br>
        <ul >
            <li>
                <input type="checkbox" id="coupons_customer" name="coupons[]" value="customer">
                <label for="coupons_customer">Customer</label>
            </li>
            <li>
                <input type="checkbox" id="coupons_weekly" name="coupons[]" value="weekly">
                <label for="coupons_weekly">Weekly coupons</label>
            </li>
            <li>
                <input type="checkbox" id="coupons_monthly" name="coupons[]" value="monthly">
                <label for="coupons_monthly">Monthly coupons</label>
            </li>
            <li>
                <input type="checkbox" id="coupons_promos" name="coupons[]" value="promos">
                <label for="coupons_promos">Promotions & offers</label>
            </li>
        </ul>
      
            <input type="checkbox" id="coupons_promos" name="coupons[]" value="promos">
            <label for="coupons_promos">I want to receive Grocerific newsletter.</label><br><br>


        <input type="submit" class="button" value="Register">
    </form>
</body>
</html>