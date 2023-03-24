<?php
session_start();
require('action_php/config.php');

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
    <title>Map</title>

    <link rel="shortcut icon" href="img/mascote/mascote1small.png">

    <link rel="stylesheet" href="css/map.css">
    <script src="js/map.js" defer></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

                                      <!-- Librairie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

                                    <!--API  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
</head>
<body>
    <!-- SONG -->

    <audio id="Audio">
        <source src="/song/click-song1.mp3" type="audio/mpeg">
    </audio>

    <!-- Map -->

<div id="mapid"></div>

    <!-- Info Page -->
<div class="height-page">

        <!-- Search -->

    <aside>
        <div class="en-tete">
            <div class="other">
                <img src="<?php echo $pp_user ?>" alt="pp-user">
            </div>
            <div class="txt">
                <p><?php echo $username ?></p>
                <p><!--Mettre $Number_of_friends--></p>
            </div>
            <form class="search">
                <input id="recherche" type="search" placeholder="Search a place">
                <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
            </form>
        </div>
        <form class="search2">
            <input id="recherche" type="search" placeholder="Search a place">
            <div class="icon"><i class="fa-solid fa-magnifying-glass"></i></div>
        </form>
        <div class="btn-box">
            <button id="Parc">Parc</button> <button>Town</button> <button>Hall</button> <button>Transport</button>
        </div>
        <div class="nav2">
            <div class="ancre"><a href="index.php">Home</a> <a href="/sign/members/members.php">Settings</a> <a href="#">Chat</a></div>
        </div>
    </aside>

        <!-- NavBar = Nav -->

    <nav>
        <div class="ancre"><a href="index.php">Home</a> <a href="/sign/members/members.php">Settings</a> <a href="#">Chat</a></div>
    </nav>
</div>
</body>
</html>