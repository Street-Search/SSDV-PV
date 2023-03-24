<?php
require('config.php');
session_start();

if (isset($_POST['email']) AND $_POST['password']){
    $usermail = stripslashes($_REQUEST['email']);
    $usermail = mysqli_real_escape_string($conn, $usermail);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $query = "SELECT * FROM `users` WHERE email='$usermail' and password='".hash('sha256', $password)."'";
    $result = mysqli_query($conn,$query) or die(mysqli_error($conn));
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $_SESSION['email'] = $usermail;
        header("Location: ../members/members.php");
        exit();
    }else{
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
        header("Location: ../sign-up.html");
        exit();
    }
}
?>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>