<?php

$invalid_form = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require __DIR__ . "/base-connect.php";

        // var_dump($_POST["email"]);
        // var_dump($_POST["password"]);

    // $mysqli->query("SELECT * FROM user WHERE email = {$_POST["email"]}");
    
    $email = $mysqli->escape_string($_POST["email"]);
        // var_dump($email);
        
    $result = $mysqli->query("SELECT * FROM user WHERE email = '{$email}'");

    $user = $result->fetch_assoc();
        // var_dump($user);

        // var_dump($user["password_hash"]);
        // var_dump($_POST["password"]);


    if (password_verify($_POST["password"], $user["password_hash"])) {

        session_start();

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_name"] = $user["name"];
            // var_dump($_SESSION["user_id"]);
            // var_dump($_SESSION["user_name"]);

        header ('Location: home-page.php');    

    } else {
        $invalid_form = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.min.css">


</head>

<body>
    <h1>Login</h1>

    <?php 
    if ($invalid_form) {
        print("<p>invalid login attempt</p>");
    } 
    ?>

    <form method="post" novalidate>
        <label for="name">Email</label>
        <input type="email" name="email" value="anna@mail.ru">
        <label for="name">Password</label>
        <input type="password" name="password" value="qwerty123">

        <button>Log in</button>
    </form>

</body>
</html>