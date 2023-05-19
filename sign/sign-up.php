<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
       <link rel="shortcut icon" href="img/mascote/mascote1small.png">

    <link rel="stylesheet" href="../css/sign.css">
    <script src="/js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"></script>
</head>
<body>
    <!-- Cirlce Transition -->

    <div class="cicle-transi"></div>

    <a href="../index.php" class="arrow"><br>&#8192;<i class="fa-solid fa-arrow-left"></i></a>
    <main>
        <h3>Sign up</h3>
        <form action="action_php/register.php" method="post">
            <div class="inputbox">
                <input type="text" name="email" required="required">
                <span>Email</span>
            </div>
            <div class="inputbox">
                <input type="text" name="username" required="required">
                <span>Name</span>
            </div>
            <div class="inputbox">
                <input type="password" name="password" required="required">
                <span>Password</span>
            </div>

            <div class="check">
                <input type="checkbox" required="required"><label for="checkbox">By creating an accont, I agree to this website's <a onclick="error()" href="#">privacy policy</a> and <a onclick="error()" href="#">terms of service</a></label>
            </div>
            

            <input type="submit" name="submit" value="Sign-up">

            <div class="have-account">
                <p>Already have an accont ?</p> <a class="link-animated" href="../sign/sign-in.php">Log In</a>
            </div>
            
        </form>
    </main>
</body>
</html>