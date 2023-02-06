<?php

$mysqli = new mysqli ("127.0.0.1", "root", null, "login_db");

// var_dump($mysqli);

if ($mysqli->connect_errno) {
    die ("Error code: $mysqli->connect_errno. <br>Error massage: $mysqli->connect_error");
}
var_dump($mysqli);
return $mysqli;






