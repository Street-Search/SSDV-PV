<?php
session_start();
require('config.php');

// Retrieve the username of the logged in user from the database
$email = $_SESSION['email'];
$query = "SELECT `id`,`email`,`password`, `avatar` FROM `users` WHERE email = '$email'";
$result = mysqli_query($conn, $query);

// Extract the username from the result set
if ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $email = $row['email'];
    $pwd = $row['password'];
    $oldAvatar = $row['avatar'];
}
else {
    $username = 'unknown';
}

// Check if the form has been submitted
if (isset($_POST['saveAvatar'])) {
    // Get the image file details
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type'];

    // Check if the file is an image
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png'];
    if (in_array($imageExt, $allowedExt)) {
        // Check if there's an error with the file upload
        if ($imageError === 0) {
            // Generate a unique filename for the image
            $imageNewName = 'avatar_' . $id . '.' . $imageExt;

            // Set the file destination path
            $imageDestination = '../members/pp_users/' . $imageNewName;

            // Delete the old avatar file if it exists
            if (!empty($oldAvatar) && file_exists($oldAvatar)) {
                unlink($oldAvatar);
            }

            // Upload the image to the server
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Save the image filename to the database or wherever you store the user's avatar information
                $avatar_path = $imageDestination;
                $query = "UPDATE `users` SET `avatar`='$avatar_path' WHERE `id` = '" . mysqli_real_escape_string($conn, $id) . "'";

                // execute the query
                $query_result = mysqli_query($conn, $query);
                if ($query_result) {
                    $successMessage = 'Avatar saved successfully';
                    header('Location: ../members/members.php');
                    exit();
                } else {
                    $errorMessage = 'There was an error updating the database try again later';
                    header('Location: ../members/members.php');
                    exit();
                }
            } else {
                $errorMessage = 'There was an error uploading your file try again later';
                header('Location: ../members/members.php');
                exit();
            }
        } else {
            $errorMessage = 'There was an error uploading your file please try again later';
            header('Location: ../members/members.php');
            exit();
        }
    } else {
        $errorMessage = 'Invalid file type your file needs to be in jpg, jpeg, or png';
        header('Location: ../members/members.php');
        exit();
    }
}
echo $errorMessage;
?>
