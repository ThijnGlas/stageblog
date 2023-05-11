<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require("functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog");

//hier doe ik een checklogin dit is een functie uit functions.php hier geef ik een uitleg van in mijn functions.php
check_login($_COOKIE['user_id'], $_COOKIE['session'], $_COOKIE['ip']);

//hier maak ik een lege variable aan die ik aanpas via een get zo kan ik berichten meegeven over wat er gebeurd
$message = "";
//in deze if statement kijk ik of er een page is in de url via get
if(array_key_exists('page', $_GET)){ 
    //hier check ik naar welke pagina ik moet gaan via de get die ik mee geef via header('location')
    $include_page = $_GET['page']; 
    if(!file_exists($include_page.".php")){ $include_page = "pagenotfound"; } 
} else { $include_page = "articles"; }

//in deze if statement kijk ik of er een action is in de url via get
if(array_key_exists('action', $_GET)){
    //deze get gebruik ik om de message variable te veranderen. Zo kan ik makkelijk een message mee geven over wat er gebeurd in de cms zoals als een artikel word toegevoegd.
    if($_GET['action'] == "article_posted"){
        $message = "<div class=\"message succesmessage\">Het artikel is toegevoegd</div>";
    }
    elseif($_GET['action'] == "article_updated"){
        $message = "<div class=\"message updatemessage\">Het artikel is geupdate</div>";
    }
    elseif($_GET['action'] == "article_deleted"){
        $message = "<div class=\"message deletemessage\">Het artikel is verwijderd</div>";
    }
    elseif($_GET['action'] == "article_notfound"){
        $message = "<div class=\"message deletemessage\">Het artikel is niet gevonden</div>";
    }
    elseif($_GET['action'] == "user_added"){
        $message = "<div class=\"message updatemessage\">De gebruiker is toegevoegd</div>";
    }
    elseif($_GET['action'] == "user_updated"){
        $message = "<div class=\"message updatemessage\">De gebruiker is geupdate</div>";
    }
    elseif($_GET['action'] == "user_deleted"){
        $message = "<div class=\"message deletemessage\">De gebruiker is verwijderd</div>";
    }
    elseif($_GET['action'] == "user_notfound"){
        $message = "<div class=\"message deletemessage\">De gebruiker is niet gevonden</div>";
    }
    elseif($_GET['action'] == "error"){
        $message = "<div class=\"message deletemessage\">Er is iets fout gegaan</div>";
    }
    elseif($_GET['action'] == "category_added"){
        $message = "<div class=\"message updatemessage\">De categorie is toegevoegd</div>";
    }
    elseif($_GET['action'] == "category_updated"){
        $message = "<div class=\"message updatemessage\">De categorie is geupdate</div>";
    }
    elseif($_GET['action'] == "category_deleted"){
        $message = "<div class=\"message deletemessage\">De categorie is verwijderd</div>";
    }
    elseif($_GET['action'] == "category_notfound"){
        $message = "<div class=\"message deletemessage\">De categorie is niet gevonden</div>";
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Koulen&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/5dzu38lr2hsa7ztc8ovdv8wo392bstbb9rop1u9yixtsasvg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    //Hier zet ik een tinymce editor in zodat ik die kan gebruiken in mijn toevoegen en updaten van artikels of projecten.
    tinymce.init({
      selector: 'textarea',
      height: 600,
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>     
</head>

<body>
    <nav class="nav">
        <a href="/portfolio/homepage/"><img src="./logo_wit.png" alt=""></a>
        <h2>hallo <?= $_COOKIE['firstname'], " ", $_COOKIE['lastname'] ?></h2>
    </nav>
    <main>
        <div class="side-menu">
            <ul>
                <a href="?page=articles">
                    <li>artikels</li>
                </a>
                <a href="?page=users">
                    <li>gebruikers</li>
                </a>
                <a href="?page=categories">
                    <li>categorieen</li>
                </a>
                <a href="">
                    <li>commentaar</li>
                </a>
                <a href="">
                    <li>ip adressen</li>
                </a>
            </ul>
            <button>uitloggen</button>
        </div>
        <div class="content-wrapper">
            <?= $message ?>
            <?php include($include_page.".php"); ?>
        </div>
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
        <link rel="stylesheet" href="cms.css">
        <script src="https://kit.fontawesome.com/b4b1cc196b.js" crossorigin="anonymous"></script>
    </footer>
</body>

</html>