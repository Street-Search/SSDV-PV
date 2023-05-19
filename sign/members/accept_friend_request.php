<?php
session_start();
require('../action_php/config.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../sign-in.php");
    exit();
}

// Retrieve the username of the logged in user from the database
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
// ...

if (isset($_GET['request'])) {
  $senderID = $_GET['request'];

  // Insert a new entry in the "friends" table
  $insertQuery = "INSERT INTO friends (user_one, user_two) VALUES ($userID, $senderID)";
  $insertResult = mysqli_query($conn, $insertQuery);
  if (!$insertResult) {
    echo "Error inserting into friends table: " . mysqli_error($conn);
  }

  // Delete the entry from the "friend_request" table
  $deleteQuery = "DELETE FROM friend_request WHERE sender = $senderID AND receiver = $userID";
  $deleteResult = mysqli_query($conn, $deleteQuery);
  if (!$deleteResult) {
    echo "Error deleting from friend_request table: " . mysqli_error($conn);
  }

  // Redirect the user to the "friends.php" page after accepting the request
  header("Location: members.php");
  exit;
}

?>