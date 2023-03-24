<?php
session_start();
require('config.php');

if(isset($_POST['pwd_submit'])) {
    $new_pwd = mysqli_real_escape_string($conn, $_POST['new_pwd']);
    $user_id = $_SESSION['user_id'];

    //Mettre à jour le password de l'utilisateur
    $query = "UPDATE `users` SET `password` = '$new_pwd' WHERE `id` = '$user_id'";
    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['password'] = $new_pwd;
        echo "Your password has been changed"; //password changé
    }else{
        echo "Something went wrong, please try again later";
    }
}
?>