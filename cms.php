<?php

require("functions.php");

$connection = dbconnect("stageblog");

check_login($_COOKIE['user_id'], $_COOKIE['session'], $_COOKIE['ip']);

$message = "";
if(array_key_exists('page', $_GET)){ 
    $include_page = $_GET['page']; 
    if(!file_exists($include_page.".php")){ $include_page = "pagenotfound"; } 
} else { $include_page = "articles"; }
if(array_key_exists('action', $_GET)){
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
    elseif($_GET['action'] == "error"){
        $message = "<div class=\"message deletemessage\">er is iets fout gegaan</div>";
    }
    elseif($_GET['action'] == "user_notfound"){
        $message = "<div class=\"message deletemessage\">deze gebruiker is niet gevonden</div>";
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
    tinymce.init({
      selector: 'textarea',
      height: 600,
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script>
</head>

<body>
    <nav class="nav">
        <a href="/portfolio/homepage/"><img src="./logo_wit.png" alt=""></a>
        <h2>hallo
            <?= $_COOKIE['firstname'], " ", $_COOKIE['lastname'] ?>
        </h2>
    </nav>
    <main>
        <div class="side-menu">
            <ul>
                <a href="?page=articles">
                    <li>artikels</li>
                </a>
                <a href="">
                    <li>projecten</li>
                </a>
                <a href="?page=users">
                    <li>gebruikers</li>
                </a>
                <a href="">
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