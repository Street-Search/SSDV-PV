<?php
session_start();
require('config.php');

//Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: ../sign-in.html");
    exit();
}

//Traitement de l'email pour le changer
if(isset($_POST['email_submit'])) {
    $user_id = $_SESSION['user_id'];
    $new_email = mysqli_real_escape_string($conn, $_POST['new_email']);

    //Mettre à jour l'email de l'utilisateur dans la base de données
    $query = "UPDATE `users` SET `email` = '$new_email' WHERE `id` = '$user_id'";
    $result = mysqli_query($conn, $query);

    if($result){
        $_SESSION['email'] = $new_email;
        echo "Your email has been changed !"; //Email changé
    }else{
        echo "Something went wrong, please try again later"; //Erreur quelque chose s'est mal passé, essayez plus tard
    }
}
?>
