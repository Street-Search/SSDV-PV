<?php
session_start();
require('../action_php/config.php');

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../sign-in.html");
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
}
else {
    $username = 'unknown';
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
        <script src="../../js/compte.js" defer></script>
        <link rel="stylesheet" href="../../css/compte.css">

        <!-- LIBRAIRIES -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</head>
<body>
    <nav>
        <div class="logo"><img src="../../img/mascote/mascote2.png" alt="logo street-search">&#8192;<h3 translate="no">Street-Search</h3></div>
        <div class="ancre"><a href="../../index.php">Home</a> <a href="../../map.php">Maps</a> <a onclick="error()" href="#">Chat</a> <a onclick="error()" href="#"><img src="../../img/pp/pp.png" alt="pp-Compte"></a></div>
    </nav>

    <!-- TITLE -->

    <div class="title">
        <h1>Welcome, <?php echo $username ?> !</h1>
        <p>Here you could modify your settings</p>
        <a href="../action_php/log_out.php">Logout</a>
    </div>

    <section class="settings">
        <h2>* Private informations</h2>
        <div class="content1">
            <div class="box">
                <div class="mini-box">
                    <b>Email: <?php echo $user_mail?></b>
                    <form action="../action_php/update_email.php" method="post">
                        <input type="email" name="new_email" placeholder="Change here" required>
                        <button class="update 1" name="email_submit" type="submit">Save</button>
                    </form>
                </div>
                <div class="mini-box">
                    <b>Password: <?php echo $user_pwd?></b>
                    <form action="../action_php/update_pwd.php" method="post">
                        <input type="password" name="new_pdw" placeholder="Change here" required>
                        <button class="update 2" name="pwd_submit" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>* Public informations</h2>
<div class="content2">
    <aside>
        <form method="POST" action="../action_php/avatar.php" enctype="multipart/form-data" id="image-form">
            <div class="en-tete">
                <div class="other">
                    <img src="<?php echo $pp_user ?>" alt="pp-user">
                    <input type="file" name="image" id="image-input">
                    <span><i class="fa-solid fa-image"></i></span>
                </div>
                <div class="txt">
                    <p><?php echo $username ?></p>
                    <p><!--Mettre $Number_of_friends--></p>
                </div>
            </div>
            
            <div class="btn-avatar"><input class="saveAvatar" type="submit" name="saveAvatar" value="Save"></input></div>


            <?php if (isset($errorMessage)): ?>
                <div class="error-message"><?php echo $errorMessage ?></div>
            <?php endif; ?>

            <?php if (isset($successMessage)): ?>
                <div class="success-message"><?php echo $successMessage ?></div>
            <?php endif; ?>
        </form>
        <form>
                <b>Description</b>
                <textarea style="resize: none;" placeholder="Write your description"></textarea>
                <div class="btn"><input type="reset" value="Reset"></input><input type="submit" value="Save"></input></div>
        </form>    
                <b>Want to talk ?</b>
                <input type="text" placeholder="Send a message">
            </aside>
            
            <section class="friends">
                <div class="Fbox"><img src="../../img/mascote/mascote2.png" alt="PP-Friends"><p>Your future friend</p><button><i class="fa-solid fa-xmark"></i></button></div>
                <!-- <div class="Fbox"><img src="../../img/pp/ppFat.png" alt="PP-Friends"><p>{Friend username}</p><button><i class="fa-solid fa-xmark"></i></button></div> -->
            </section>
        </div>

        <h2>* Your Points</h2>
        <div class="content3">
            <div class="Ypoints">
                <div class="en-tete">
                    <div class="color"></div>
                    <div class="txt"><p>Ex: Point name</p><p>Ex: Point's adress</p></div>
                </div>
                <form method="post" class="YP-add">
                    <b>Description</b>
                    <textarea style="resize: none;" placeholder="Write description of the points"></textarea>
                    <div class="btn"><input type="reset" value="Reset"></input><input type="submit" value="Done"></input></div>
                </form>
            </div>
            <!-- <div class="Ypoints">
                <div class="en-tete">
                    <div class="color"></div>
                    <div class="txt"><p>{Point name}</p><p>{Point's adress}</p></div>
                </div>
                <form method="post" class="YP-add">
                    <b>Description</b>
                    <textarea style="resize: none;" placeholder="Write description of the points"></textarea>
                    <div class="btn"><input type="reset" value="Reset"></input><input type="submit" value="Done"></input></div>
                </form>
            </div> -->
        </div>

        <h2>* Friends' points</h2>
        <div class="content4">
            <section class="box">
                <div class="Fpoints"><div class="color"></div><p>Future friend Point name</p></div>
                <!-- <div class="Fpoints"><div class="color"></div><p>{Friend Point name}</p></div> -->
            </section>
        </div>
    </section>

        <!-- FOOTER -->

<footer id="Footeur">
    <div class="box">
        <div class="copyright">
            <p>Copyright © 2022&#8192;</p><a href="">BRIX Templates</a>
        </div>
        <div class="term-privacy">
            <p>All Rights Reserved |&#8192;</p><a href="">Terms and Conditions</a><p>&#8192;|&#8192;</p><a href="">Privacy Policy</a>
        </div>
</div>
</footer>
</body>
</html>