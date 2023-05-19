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
    $_SESSION['userID'] = $userID; // Store the user ID in the session
    $username = $row['username'];
    $user_mail = $row['email'];
    $user_pwd = $row['password'];
    $pp_user = $row['avatar'];
}
else {
    $username = 'unknown';
}


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the friend name from the form
  $friendName = $_POST['username'];

  // Get the user ID of the logged-in user
  $userID = $_SESSION['userID'];

  // Search for the friend in the database
  $searchQuery = "SELECT * FROM users WHERE username = '$friendName'";
  $searchResult = mysqli_query($conn, $searchQuery);

  if ($searchResult && mysqli_num_rows($searchResult) > 0) {
      // Friend found, insert a new entry in the friend_request table
      $friend = mysqli_fetch_assoc($searchResult);
      $friendID = $friend['id'];

      // Check if a friend request already exists
      $existingRequestQuery = "SELECT * FROM friend_request WHERE sender = $userID AND receiver = $friendID";
      $existingRequestResult = mysqli_query($conn, $existingRequestQuery);

      if ($existingRequestResult && mysqli_num_rows($existingRequestResult) > 0) {
          echo "A friend request has already been sent to this user.";
      } else {
          // Insert a new friend request
          $insertQuery = "INSERT INTO friend_request (sender, receiver) VALUES ($userID, $friendID)";
          $insertResult = mysqli_query($conn, $insertQuery);

          if ($insertResult) {
              echo "Friend request sent successfully.";
              header("Location: ../members/members.php");
              exit();
          } else {
              echo "Error: " . mysqli_error($conn);
          }
      }
  } else {
      echo "Friend not found.";
  }
}
?>