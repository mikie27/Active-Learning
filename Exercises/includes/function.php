<?php
/*
$global ="hello";
my_function();
echo "outside my_function(), \$global = '$global'<br><br><br>";

function my_function() {
    global $global;
    echo "inside my_function(), \$global = '$global'<br>";
    $global = "changed";
}

function add(&$value, $amount = 1) {
    $value += $amount;
}

$var = 10;
add($var);
echo "$var<br><br>";



*/
function larger ($a, $b){
    if (!isset($a) || !isset($b)){
        echo "Both parameters must be set.<br>";
        return;
    }
    return ($a > $b) ? $a : $b;
}
$x = 5;
$y = 10;

echo larger($x, $y) ."<br><br>"; // Outputs: 10
echo larger($y, $x) ."<br><br>";

?>
