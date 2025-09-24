<?php
$str = 'hello';
for ($i =0; $i< strlen($str); $i++) {
echo "$str {$i}". "<br>";
}

for ($i =0; $i< 5; $i++) {
echo "$str {$i}" . "<br>";
}

$phrase = "I love programming";
$thingsIlove = ['design','art', 'sleeping'];
$bodytag = str_replace("programming","$thingsIlove[2]", $phrase);

echo $bodytag;
?>