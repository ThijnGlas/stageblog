<?php
if (array_key_exists('page', $_GET)) {
    //hier check ik naar welke pagina ik moet gaan via de get die ik mee geef via header('location')
    $include_page = $_GET['page'];
    if (!file_exists($include_page . ".php")) {
        $include_page = "homepage";
    }
} 
else {
    $include_page = "homepage";
}


?>


<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./stylepublic.css">
</head>

<body>
    <nav class="nav">
        <a href="?page=homepage"><img src="./img/logo_wit.png" alt=""></a>
        <ul>
            <a href="?page=wieisthijn">
                <li>Wie is thijn?</li>
            </a>
            <a href="?page=leadmachine">
                <li>Lead machine</li>
            </a>
            <a href="?page=berichten">
                <li>berichten</li>
            </a>
        </ul>
</nav>

        <?php include("./".$include_page."/".$include_page.".php"); ?>
    <footer class="footer">
        <a href="/portfolio/homepage/index.html"><img src="./img/logo_wit.png" alt="logo"></a>
        <div>
            <a href="mailto:thijnglas@gmail.com"><i class="fa-regular fa-envelope"></i></a>
            <ul>
                <a href="?page=wieisthijn">
                    <li>Wie is thijn?</li>
                </a>
                <a href="?page=leadmachine">
                    <li>Lead machine</li>
                </a>
                <a href="?page=berichten">
                    <li>berichten</li>
                </a>
            </ul>
        </div>
        <link rel="stylesheet" href="./<?= $include_page ?>/<?= $include_page ?>.css">
        <script src="https://kit.fontawesome.com/b4b1cc196b.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>