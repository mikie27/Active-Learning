<?php 
$rows = 10;
$cols = 5;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>sdfsdf</h1>
    <table>
        <thead>
            <tr>
                <th>Header 1</th>
                <th>Header 2</th>
                <th>Header 3</th>
                <th>Header 4</th>
                <th>Header 5</th>
            </tr>
        </thead>
        <tbody>
        
            <?php 
             for ($j =1; $j <= $rows; $j++) { ?>
                <tr style="background-color: <?php echo ($j % 2 == 1) ? "#6513eaff" : "#680404ff";?> "> <?php
            for ($i = 1; $i<= $cols; $i++){ ?>
                <td><?php echo "$i". "-" . "$j"; ?></td><?php
                }?>
            </tr> <?php
            }
                ?> 
                </tbody>
    </table>
</body>
</html>