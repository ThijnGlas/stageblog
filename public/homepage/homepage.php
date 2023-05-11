<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("../cms/functions.php");

//hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog");


?>
    <header>
        <div>
            <h1>Thijn Glas</h1>
            <h2>stageblog</h2>
        </div>
        <img src="./img/header_image.png" alt="">
    </header>
    <main>
    <div class="berichten">
            <h2>Andere berichten</h2>
        </div>
        <div class="wrapper">
            <?php
            $get_articles = mysqli_query($connection, "SELECT * FROM articles ORDER BY id DESC LIMIT 4") or die(mysqli_error($connection));
            while ($articlecard = mysqli_fetch_array($get_articles)) {
                echo "
                <a href=\"?page=berichten&id=".$articlecard['id']."\">
                <div class=\"card\">
                <div class=\"card__imgWrapper\">
                    <img src=\"./img/erp-expert.png\" alt=\"\">
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
            <div class="leadmachine">
                <div>
                    <h2>Lead Machine</h2>
                    <p>
                        Nunc ac augue ac mi ultricies malesuada. Fusce pretium urna tortor, sit amet tincidunt elit viverra
                        rhoncus. Nulla sagittis sapien ante, eget malesuada turpis posuere in. Donec scelerisque orci est,
                        in ullamcorper ante ultrices vitae.<br><br> 

                        Nulla sagittis sapien ante, eget malesuada turpis posuere in. Donec scelerisque orci est,
                        in ullamcorper ante ultrices vitae.Nulla sagittis sapien ante, eget malesuada turpis posuere in. Donec scelerisque orci est,
                        in ullamcorper ante ultrices vitae.

                    </p>
                    
                </div>
                <a href="/portfolio/leadmachine/leadmachine.html"><button class="button">lees verder</button></a>
            </div>
            <div class="leadmachine__img">
                <img src="./img/leadmachine.png" alt="">
            </div>
        </div>
    </main>
    