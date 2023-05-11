<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog"); 

//eerst check ik of er een post is gemaakt.
if (isset($_POST['toevoegenForm'])) {
  //dan kijk ik of er een editId is in de post en of die leeg is
  if (array_key_exists('editId', $_POST) && trim($_POST['editId']) == "") {
    //als dat zo is zet ik dit de values van de post in mijn database ik gebruik mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_added zodat ik die kan gebruiken voor de message in de cms
    mysqli_query(
      $connection,
      "INSERT INTO articles 
    (user_id, article, publisheddate, articlestatus_id, title,	category_id,	slug,	heroimg,	projecturl,	tijdsduur, concept, shortdescription, highlight)
    values
    ('" .mysqli_real_escape_string($connection, $_COOKIE['user_id']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['articleInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['datumInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['statusInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['titleInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['categoryInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['urlInput']) . "',
    '" . mysqli_real_escape_string($connection, $_POST['imgInput']) . "',
    '" . mysqli_real_escape_string($connection, $_POST['projecturlInput']) . "',
    '" . mysqli_real_escape_string($connection, $_POST['stageurenInput']) . "',
    '" . mysqli_real_escape_string($connection, $_POST['conceptInput']) . "',
    '" . mysqli_real_escape_string($connection, $_POST['shortdescriptionInput']) . "',
    '" . mysqli_real_escape_string($connection, $_POST['highlightInput']) . "'
    )"
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=articles&action=article_posted");

  } 
  else {
    //als ik wel een editId mee krijg zet ik dit de values van de post in mijn database met een update where id editId ik gebruik hier ook mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action article_updated zodat ik die kan gebruiken voor de message in de cms
    mysqli_query(
      $connection,
      "UPDATE articles SET 
      update_user_id = '".mysqli_real_escape_string($connection, $_COOKIE['user_id'])."', 
      article = '".mysqli_real_escape_string($connection, $_POST['articleInput']) ."',
      modifacationdate = '".mysqli_real_escape_string($connection, $_POST['datumInput']) ."',
      articlestatus_id = '".mysqli_real_escape_string($connection, $_POST['statusInput']) ."',
      title = '".mysqli_real_escape_string($connection, $_POST['titleInput']) ."',
      category_id = '".mysqli_real_escape_string($connection, $_POST['categoryInput']) ."',
      slug = '".mysqli_real_escape_string($connection, $_POST['urlInput']) ."',
      heroimg = '".mysqli_real_escape_string($connection, $_POST['imgInput']) ."',
      projecturl = '".mysqli_real_escape_string($connection, $_POST['projecturlInput']) ."',
      tijdsduur = '".mysqli_real_escape_string($connection, $_POST['stageurenInput']) ."', 
      concept = '".mysqli_real_escape_string($connection, $_POST['conceptInput']) ."',
      shortdescription = '".mysqli_real_escape_string($connection, $_POST['shortdescriptionInput']) ."',
      highlight = '".mysqli_real_escape_string($connection, $_POST['highlightInput']) ."'
      WHERE id = '".$_POST['editId']."' LIMIT 1
      "
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=articles&action=article_updated");
  }
}

//ik kijk hier of er een id is met get die zet ik in de $editId hiermee kan ik in mijn database kijken wat er allemaal al qua values instaan zodat het makkelijk aan te passen is als je op een artikel klik
if (array_key_exists('id', $_GET)) {
  $editId = $_GET['id'];
  //SQL query voor ophalen informatie
  $get_article = mysqli_query($connection, "SELECT * FROM articles WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));
  while ($article = mysqli_fetch_array($get_article)) {
    $titleInput = $article['title'];
    $urlInput = $article['slug'];
    $articleInput = $article['article'];
    $categoryInput = $article['category_id'];
    $datumInput = $article['publisheddate'];
    $stageurenInput = $article['tijdsduur'];
    $statusInput = $article['articlestatus_id'];
    $projecturlInput = $article['projecturl'];
    $conceptInput = $article['concept'];
    $imgInput = $article['heroimg'];
    $shortdescriptionInput = $article['shortdescription'];
    $highlightInput = $article['highlight'];
  }
} 
//als er geen editId is krijg je de lege values terug
else {
    $editId = "";
    $titleInput = "";
    $urlInput = "";
    $articleInput = "";
    $categoryInput = "";
    $datumInput = "";
    $stageurenInput = "";
    $statusInput = "";
    $projecturlInput = "";
    $statusInput = "";
    $conceptInput = "";
    $imgInput = "";
    $shortdescriptionInput = "";
    $highlightInput = "";
}


?>

<head>
  <link rel="stylesheet" href="toevoegen.css">
</head>
<a  href="?page=articles"><p class="terug"><- terug</p></a>
<form class="toevoeg-frm" name="toevoegenForm" method="post">
  <input type="hidden" name="toevoegenForm" value="1">
  <input type="hidden" name="editId" value="<?= $editId; ?>">
  <table>
    <thead>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td>
          <label for="title">Wat is de titel:</label>
          <input id="title" type="text" name="titleInput" value="<?= $titleInput; ?>">
        </td>
        <td>
          <label for="url">Wat word de URL:</label>
          <input id="url" type="text" name="urlInput" value="<?= $urlInput; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="category">Categorieën:</label>
          <input id="category" type="text" name="categoryInput" value="<?= $categoryInput; ?>">
        </td>
        <td>
          <label for="datum">Datum om te posten:</label>
          <input id="datum" type="datetime-local" name="datumInput" value="<?= $datumInput; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="stageuren">Hoeveel stageuren:</label>
          <input id="stageuren" type="number" name="stageurenInput" value="<?= $stageurenInput; ?>">
        </td>
        <td>
          <label for="status">Status:</label>
          <input id="status" type="text" name="statusInput" value="<?= $statusInput; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="projecturl">Project URL:</label>
          <input id="projecturl" type="text" name="projecturlInput" value="<?= $projecturlInput; ?>">
        </td>
        <td>
          <div>
          <label for="concept">Sla op als concept:</label>
          <input id="concept" type="checkbox" name="conceptInput" value="<?= $conceptInput; ?>">
          <label for="highlight">Sla op als uitgelicht bericht:</label>
          <input id="highlight" type="checkbox" name="highlightInput" value="<?= $highlightInput; ?>">
          </div>
        </td>
      </tr>
      <tr>
        <td>
          <label for="heroimg">Sla op als concept:</label>
          <input id="heroimg" type="file" name="imgInput" value="<?= $imgInput; ?>">
        </td>
        <td>
          <label for="shortdescription">hier een korte beschrijving van het artikel:</label>
          <input id="shortdescription" maxlength="200" type="text" name="shortdescription" value="<?= $shortdescriptionInput; ?>">
        </td>
      </tr>
    </tbody>
  </table>
  <textarea name="articleInput">
  <?= $articleInput; ?>
    </textarea>
  <div class="button-center">
    <input class="button post-btn" value="post" type="submit">
  </div>
</form>