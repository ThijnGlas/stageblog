<?php 
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("../../../cms/functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog"); 


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
    
    <header> 
        <h1>uitgelicht bericht</h1>
        <div>
            <article>
                <img src="erp-expertB.png" alt="">
                <div>
                    <div class="uitgelicht">
                        <div class="uitgelicht__title">
                            <h3>erp-overzicht.nl</h3>
                            <div class="tag">
                                <h4>project</h4>
                            </div>
                        </div>
                        <div class="uitgelicht__tekst">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec congue, purus id ullamcorper
                                feugiat,
                                dolor lectus varius ante, tempus pulvinar sapien tellus at dolor. In tincidunt pharetra
                                enim, at
                                vehicula ex suscipit a. Nam eros urna, porta ac finibus nec, ultricies at est.
                                Pellentesque eros
                                neque.<br><br>
    
                                dolor lectus varius ante, tempus pulvinar sapien tellus at dolor. In tincidunt pharetra
                                enim, at
                                vehicula ex suscipit a. Nam eros urna, porta ac finibus nec, ultricies at est.
                                Pellentesque eros
                                neque.
                                dolor lectus varius ante, tempus pulvinar sapien tellus at dolor. In tincidunt pharetra
                                enim, at
                                vehicula ex suscipit a. Nam eros urna, porta ac finibus nec, ultricies at est.
                                Pellentesque eros
                                neque.
                            </p>
                        </div>
                    </div>
                    <div class="button__wrapper">
                        <a href="/portfolio/project/project.html">
                            <button class="button button__s">lees verder</button>
                        </a>
                    </div>
                </div>
            </article>
        </div>
            
    </header>
    <main>
        <div class="berichten">
            <h2>Andere berichten</h2>
        </div>
        <div class="wrapper">
        <?php
            $get_articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC") or die(mysqli_error($connection));
            while ($articlecard = mysqli_fetch_array($get_articles)) {
                echo "
                <a href=\"../article/articlepublic.php?id=".$articlecard['id']."\">
                <div class=\"card\">
                <div class=\"card__imgWrapper\">
                    <img src=\"./erp-expert.png\" alt=\"\">
                </div>
                <div class=\"card__description\">
                    <h3>".$articlecard['title']."</h3>
                    <p>
                        ".$articlecard['shortdescription']." 
                    </p>
                    <p>lees verder...</p>
                </div>
                </div>
                </a>";
            }
            ?>
            
        </div>
        <!-- <div class="pagina">
            <a href="">vorige</a>
            <p>1</p>
            <a href="">volgende</a>
        </div> -->
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
        <link rel="stylesheet" href="uitgelichtbericht.css">
        <script src="https://kit.fontawesome.com/b4b1cc196b.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>