<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("../../../cms/functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog"); 

$urlId="";

if(array_key_exists('id', $_GET)){
    $urlId = $_GET['id'];
    $get_article = mysqli_query($connection, "SELECT * FROM articles WHERE id = '" . $urlId . "' LIMIT 1") or die(mysqli_error($connection));
while ($article = mysqli_fetch_array($get_article)) {
    $title = $article['title'];
    $text = $article['article'];
    $category = $article['category_id'];
    $datum = $article['publisheddate'];
    $stageuren = $article['tijdsduur'];
    $status = $article['articlestatus_id'];
    $projecturl = $article['projecturl'];
    $concept = $article['concept'];
    $img = $article['heroimg']; 
}
} else{
    header('location: articlepublic.php?page=article-not-found');
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
    <link rel="stylesheet" href="../../stylepublic.css">
</head>

<body>
    <nav>
        <a href="/public/homepage/homepage"><img src="./logo_wit.png" alt=""></a>
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
        <img src="code.png" alt="">
        <div class="content__wrapper">
            <div class="content">
                <h1><?= $title ?></h1>
                <?= $text ?>
            </div>
            <div class="sidemenu">
                <div class="green">
                    <h4>stage uren deze week:</h4>
                    <p><?= $stageuren ?> uren</p>
                </div>
                <div class="grey">
                    <h4>Introductie</h4>
                    <h4>Maandag</h4>
                    <h4>Dinsdag</h4>
                    <h4>Woensdag</h3>
                    <h4>Donderdag</h4>
                    <h4>vrijdag</h4>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <a href="/portfolio/homepage/index.html"><img src="logo_wit.png" alt="logo"></a>
        <div>
            <a href="mailto:thijnglas@gmail.com"><i class="fa-regular fa-envelope"></i></a>
            <ul>
                <a href="/wie-is-thijn"><li>Wie is thijn?</li></a>
                <a href="/portfolio/leadmachine/leadmachine.html"><li>Lead machine</li></a>
                <a href="/portfolio/berichten/uitgelichtbericht.html"><li>berichten</li></a>
            </ul>
        </div>
        <link rel="stylesheet" href="articlepublic.css">
        <script src="https://kit.fontawesome.com/b4b1cc196b.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>