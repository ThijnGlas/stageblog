<?php
require("functions.php"); 

 //hier word een error message variable aangemaakt die aangepast word zodat er gemeld word wat er mis is
 $error_message = "";
 $connection = dbconnect('stageblog');

if (isset($_POST['loginForm'])) {
    //in deze if statement check ik of mijn username en password beide zijn gepost en of ze niet leeg zijn, hier gebruik ik ook een trim zodat er geen spaties in kunnen staan want als er een spatie in zou staan zou hij tellen als niet leeg terwijl hij dat wel is.
    if (array_key_exists('usernameInput', $_POST) && trim($_POST['usernameInput']) != "" && array_key_exists('passwordInput', $_POST) && trim($_POST['passwordInput'] != "")) {
        //in deze if statement check ik of mijn username en password wel matchen en als dat zo is redirect ik hem met header('location: ')
        $check_login = mysqli_query($connection, "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($connection, $_POST['usernameInput']) . "' AND password = '" . hash('sha256', mysqli_real_escape_string($connection, $_POST['passwordInput'])) . "' LIMIT 1");
        if (mysqli_num_rows($check_login) == 1) {
            //hier geef ik mijn gegevens mee aan de user als cookies
            while($user = mysqli_fetch_array($check_login)){ 
                $user_id = $user['id'];
                setcookie("user_id", $user['id']);
                setcookie("firstname", $user['voornaam']); 
                setcookie("lastname", $user['achternaam']);
                setcookie("role_id", $user['role_id']);
            }
            $session = getRandomString(); 
            setcookie("session", $session);
            setcookie('ip', $_SERVER['REMOTE_ADDR']);
            mysqli_query($connection, "UPDATE users SET session = '".$session."', ipv4 = '". $_SERVER['REMOTE_ADDR']."' WHERE id = '".$user_id."'");
            header('location: cms.php');
        } 
        else {
            $error_message = "the username or password is incorrect";
        }
    } 
    else {
        $error_message = "the username or password is not filled in";
    }


}


?>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="nav">
        <a href="/portfolio/homepage/"><img src="./logo_wit.png" alt=""></a>
        <ul>
            <a href="">
                <li>Wie is thijn?</li>
            </a>
            <a href="/portfolio/leadmachine/leadmachine.html">
                <li>Lead machine</li>
            </a>
            <a href="/portfolio/berichten/uitgelichtbericht.html">
                <li>berichten</li>
            </a>
        </ul>
    </nav>
    <main>
        <img src="login_bc.png" alt="">
        <form name="loginForm" action="index.php" method="post">
            <img src="logo_wit.png" alt="">
            <input type="hidden" name="loginForm" value="1">
            <h2>
                <?= $error_message ?>
            </h2>
            <input type="text" placeholder="username" name="usernameInput">
            <input type="password" placeholder="password" name="passwordInput">
            <input class="submit-knop" value="log in" type="submit">
        </form>
    </main>
    <footer class="footer">
        <a href="/portfolio/homepage/index.html"><img src="logo_wit.png" alt="logo"></a>
        <div>
            <a href="mailto:thijnglas@gmail.com"><i class="fa-regular fa-envelope"></i></a>
            <ul>
                <a href="/wie-is-thijn">
                    <li>Wie is thijn?</li>
                </a>
                <a href="/portfolio/leadmachine/leadmachine.html">
                    <li>Lead machine</li>
                </a>
                <a href="/portfolio/berichten/uitgelichtbericht.html">
                    <li>berichten</li>
                </a>
            </ul>
        </div>
        <link rel="stylesheet" href="login.css">
        <script src="https://kit.fontawesome.com/b4b1cc196b.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>