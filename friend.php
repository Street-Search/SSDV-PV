<?php
session_start();
require('sign/action_php/config.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: sign/sign-in.php");
    exit();
}

// Retrieve the username of the logged in user from the database
$email = $_SESSION['email'];
$query = "SELECT * FROM `users` WHERE email = '$email'";
$result = mysqli_query($conn, $query);


// Extract the username from the result set
if ($row = mysqli_fetch_assoc($result)) {
    $username = $row['username'];
    $user_mail = $row['email'];
    $user_pwd = $row['password'];
    $pp_user = $row['avatar'];
    $online_user_info = $row['is_online'];
}
else {
    $username = 'unknown';
}

//Retrieve other users' informations from database
$query_friend = "SELECT * FROM `users`";
$result_friend = mysqli_query($conn, $query_friend);
if($row = mysqli_fetch_assoc($result_friend)) {
    $friend_username = $row['username'];
    $friend_statut = $row['is_online'];
    $friend_pp_user = $row['avatar'];
    $last_msg_friend = $row['last_msg'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
    <link rel="shortcut icon" href="../img/mascote/mascote1.png">

        <!-- LINK -->
        <script src="js/chat.js" defer></script>
        <link rel="stylesheet" href="css/chat.css">

        <!-- LIBRAIRIES -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</head>
<body>

    <!-- Cirlce Transition -->

    <div class="cicle-transi"></div>


    <!-- ASIDE -->
    <aside>
        <!-- header -->
        <header>
            <div class="content">
                <div class="menu-btn">
                    <i class="fa-solid fa-ellipsis-vertical" style="color: #000000;"></i>
                </div>
                <div class="menu">
                    <div class="menu-header">
                      <h3>Navigation Menu</h3>
                      <button class="menu-close-btn">&times;</button>
                    </div>
                    <ul>
                        <li class="ancre"><a href="index.php">Home</a></li>
                        <li class="ancre"><a href="/sign/members/members.php">Settings</a></li>
                        <li class="ancre"><a href="#" onclick="window.location.reload(true);">Chat</a></li>
                    </ul>
                  </div>
                <form class="search">
                    <input id="search" name="search" type="search" placeholder="Research a discusion...">
                    <button class="icon" onclick="search()"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>    
        </header>
        <!-- friends -->
        <?php
            session_start();
            // Vérifie si l'utilisateur est connecté/en ligne
            if (isset($_SESSION['users'])) {
              // L'utilisateur est en ligne, donc on change la couleur de l'indicateur
              $indicator_color = 'green';
            } else {
              // L'utilisateur n'est pas en ligne, donc la couleur de l'indicateur reste rouge par défaut
              $indicator_color = 'red';
            }
        ?>


        <ul class="liste">
            <li class="friend" onclick="addActiveClass(event)"><img src="/img/mascote/mascote3aM.png" alt="ppFriend"><div class="txt"><dt class="name"><?php echo $friend_username ?>User<span class="indicator" style="background-color: <?php echo $indicator_color; ?>"></span></dt><dd class="mess"><?php echo $last_msg_friend ?>Hello tfq ?</dd></div></li>
            <li class="friend" onclick="addActiveClass(event)"><img src="<?php $friend_pp_user?>" alt="ppFriend"><div class="txt"><dt class="name"><?php echo $friend_username ?>Cuic<span class="indicator" style="background-color: <?php echo $indicator_color; ?>"></span></dt><dd class="mess"><?php echo $last_msg_friend ?>Coucou je fais des test</dd></div></li>
            <li class="friend" onclick="addActiveClass(event)"><img src="<?php $friend_pp_user?>" alt="ppFriend"><div class="txt"><dt class="name"><?php echo $friend_username ?><span class="indicator" style="background-color: <?php echo $indicator_color; ?>"></span></dt><dd class="mess"><?php echo $last_msg_friend ?></dd></div></li>
            <li class="friend" onclick="addActiveClass(event)"><img src="/img/pp/ppOglo.png" alt="ppFriend"><div class="txt"><dt class="name"><?php echo $friend_username ?><span class="indicator" style="background-color: <?php echo $indicator_color; ?>"></span></dt><dd class="mess"><?php echo $last_msg_friend ?></dd></div></li>
            <li class="friend" onclick="addActiveClass(event)"><img src="<?php $friend_pp_user?>" alt="ppFriend"><div class="txt"><dt class="name"><?php echo $friend_username ?><span class="indicator" style="background-color: <?php echo $indicator_color; ?>"></span></dt><dd class="mess"><?php echo $mess_friend ?></dd></div></li>
        </ul>

        
    </aside>
    <!-- MAIN -->
    <main>

        <div class="asideUp"><i class="fa-solid fa-chevron-up"></i></div>
        <div class="asideDown"><i class="fa-solid fa-chevron-down"></i></div>

        <!-- chat -->
        <!-- <div class="shadow"></div>-->
        <div class="chat-global">
            <section class="chat">
                <li class="mess-l">Hello</li>
                <li class="mess-r">Hello bro</li>
                <li class="mess-l">ok guys</li>
                <li class="mess-r">je mange des frite actuellement</li>
                <li class="mess-l">ok ok ça dois être vraiment bon mais je doit te laisser je pense que je vais aller coder le php pour le système d'amis et après ça j'irai voir l'amour est dans le pré puis ensuite je vais promener mon chien et si ça te dis se soir on joue a mincraft ensemble pour se détendre :)</li>
                <li class="mess-r">vsi chui chaud</li>
                <li class="mess-l">Hello</li>
                <li class="mess-r">Hello bro</li>
                <li class="mess-l">ok guys</li>
                <li class="mess-r">je mange des frite actuellement</li>
                <li class="mess-l">ok ok ça dois être vraiment bon mais je doit te laisser je pense que je vais aller coder le php pour le système d'amis et après ça j'irai voir l'amour est dans le pré puis ensuite je vais promener mon chien et si ça te dis se soir on joue a mincraft ensemble pour se détendre :)</li>
                <li class="mess-r">vsi chui chaud</li>
            </section>
        </div>
        <!-- footer -->
        <footer class="content">
            <form class="send">
                <textarea id="input-box" rows='1' placeholder="Send a message..."></textarea>
                <div class="btn">
                  <div class="icon one"><i class="fa-solid fa-images" style="color: #ffffff;"></i></div>
                  <div class="icon two"><i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i></div>
                  <div class="btn-file"><input type="file"></div>
                  <div class="btn-send"><input type="submit" value=""></div>
                </div>
            </form>
        </footer>
    </main>
</body>
</html> 