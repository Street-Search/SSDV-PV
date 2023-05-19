<?php
session_start();
require('../action_php/config.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../sign-in.php");
    exit();
}
//Retrieve the user's information of the logged in user from the database
$email = $_SESSION['email'];
$query = "SELECT * FROM `users` WHERE email = '$email'";
$result = mysqli_query($conn, $query);


// Extract the username from the result set
if ($row = mysqli_fetch_assoc($result)) {
    $userID = $row['id'];
    $username = $row['username'];
    $user_mail = $row['email'];
    $user_pwd = $row['password'];
    $pp_user = $row['avatar'];
}
if (isset($_GET['request'])) {
    $senderID = $_GET['request'];

    // Delete the entry from the "friend_request" table
    $deleteQuery = "DELETE FROM friend_request WHERE sender = $senderID and receiver = $userID";
    $deleteResult = mysqli_query($conn, $deleteQuery);
    if (!$deleteResult) {
        echo "Error deleting friend request: " . mysqli_error($conn);
    }
    //Redirect the user to the "members.php" page after rejecting the request
    header("Location: members.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Friend Request</title>
</head>
<body>
    <h1>Reject Friend Request</h1>
    <p>Are you sure you want to reject this friend request?</p>
    <a href="reject_friend_request.php?request=<?php echo $_GET['request']; ?>">Reject</a>
</body>
</html>