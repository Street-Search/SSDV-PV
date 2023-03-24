<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to sign-in page
header("Location: ../sign-in.html");
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loug out</title>
</head>
<body>
    <h1>Done !</h1>
    <a href="../../index.html">Home</a>
</body>
</html>
