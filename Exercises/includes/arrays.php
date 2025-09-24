<?php
$customers = array('Matthew'=> array('mattheew@gmail.com',25,'M'),
                    'Luke'=> array('luke@gmail.com',28,'M'),
                    'Mark'=> array('mark@gmail.com',30,'F'),
);


foreach ($customers as $name => $record){
    list($email, $age, $gender) = $record;
    echo "Name: {$name}<br>";
    echo "Email: {$email}<br>";
    echo "Age: {$age}<br>";
    echo "Gender: {$gender}<br>";
    echo '<br>';
}