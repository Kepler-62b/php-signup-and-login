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

if (empty($_POST["password_confirmation"])) {
    die ("Field PASSWORD CONFIRMATION is requierd");
} elseif ($_POST["password"] !== $_POST["password_confirmation"]) {
    die ("Field PASSWORD CONFIRMATION do not match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
 
require __DIR__ . "/base-connect.php";

    // var_dump($mysqli);

    // теперь нам нужно получить объект mysqli_stmt
    // есть несколько методов, которые возвращают объект mysqli_stmt

    // 1. через stmt_init - возращает mysqli_stmt
// $stmt = $mysqli->stmt_init(); 
    // var_dump($stmt);

    // 2. через prepare - возращает mysqli_stmt
$stmt_prepare = $mysqli->prepare("INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)");
    var_dump($stmt_prepare);

if (! $stmt_prepare) {
    die ('SQL error:' . $mysqli->error);
}
    var_dump($stmt_prepare->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash));

if ($stmt_prepare->execute()) {
    header ('Location: signup-success.html');    
} 
else {
    if ($mysqli->errno === 1062) {
        die ('email already taken');
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}





