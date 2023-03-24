<?php

session_start();

if (!isset($_SESSION['user_id'])) {
  die("You must be logged in to send friend requests.");
}

if (!isset($_POST['user_id'])) {
  die("You must provide a user ID to send a friend request.");
}

$user_id = $_SESSION['user_id'];
$friend_id = $_POST['user_id'];

$sql = "INSERT INTO friendships (user1_id, user2_id) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $friend_id);
$stmt->execute();

header('Location: profile.php?id=' . $friend_id);
exit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        
    </form>
</body>
</html>