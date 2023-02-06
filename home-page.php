<?php

session_start();

    // var_dump($_SESSION["user_id"]);
    // var_dump($_SESSION["user_name"]);



?>

<!DOCTYPE html>
<html>
<head>
    <title>Home page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.min.css">

    <?php
        $username = ucfirst($_SESSION["user_name"]);

        if (isset($username)) {
            print("<h1>Home page</h1>");
            print("<p>Welcome {$username}.</p>");
        }
    ?>

    <p><a href="logout-process.php">Log out</a>.</p>
</head>

<body>



</body>
</html>