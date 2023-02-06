<?php

if (empty($_POST["name"])) {
    die ("Field NAME is requierd");
} 

if (! filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
    die ('Incorrect email address');
}

if (strlen($_POST["password"]) < 5) {
    die ("Short passwort (less 5 symbols)");
}

function validation ($password) {
    $numbers = [
        0 => "0",
        1 => "1",
        2 => "2",
        3 => "3",
        4 => "4",
        5 => "5",
        6 => "6",
        7 => "7",
        8 => "8",
        9 => "9",
        10 => "10"
    ];
    $i = 0;
    while ($i < 10) {
        if(strpos($password, $numbers[$i])) {
            return $_POST["password"];
        } 
        $i++;
    }
    die ("Password must include numbers");
}

validation($_POST["password"]);

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
 


echo "failed";