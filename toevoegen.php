<?php
require_once("functions.php");
$connection = dbconnect("stageblog"); 

// check_login($_COOKIE['user_id'], $_COOKIE['session'], $_COOKIE['ip']);


if (isset($_POST['toevoegenForm'])) {
  if (array_key_exists('editId', $_POST) && trim($_POST['editId']) == "") {
    mysqli_query(
      $connection,
      "INSERT INTO articles 
    (user_id, article, publisheddate, articlestatus_id, title,	category_id,	slug,	heroimg,	projecturl,	tijdsduur, concept)
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
    '" . mysqli_real_escape_string($connection, $_POST['conceptInput']) . "'
    )"
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=articles&action=article_posted");
  } 
  else {
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
      concept = '".mysqli_real_escape_string($connection, $_POST['conceptInput']) ."' 
      WHERE id = '".$_POST['editId']."' LIMIT 1
      "
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=articles&action=article_updated");
  }
}


if (array_key_exists('id', $_GET)) {
  $editId = $_GET['id'];
  //SQL query voor ophalen informatie SELECT * FROM articles WHERE id = '".$editId."' LIMIT 1
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
    
  }
} else {
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
}


?>

<head>
  <link rel="stylesheet" href="toevoegen.css">
</head>
<a  href="?page=articles"><p class="terug"><- terug</p></a>
<form class="toevoeg-frm" action="cms.php?page=toevoegen" name="toevoegenForm" method="post">
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
          <label for="concept">Sla op als concept:</label>
          <input id="concept" type="checkbox" name="conceptInput" value="<?= $conceptInput; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="heroimg">Sla op als concept:</label>
          <input id="heroimg" type="file" name="imgInput" value="<?= $imgInput; ?>">
        </td>
      </tr>

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