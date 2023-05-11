<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog"); 

//eerst check ik of er een post is gemaakt.
if (isset($_POST['categoryToevoegenForm'])) {
  //dan kijk ik of er een editId is in de post en of die leeg is
  if (array_key_exists('editId', $_POST) && trim($_POST['editId']) == "") {
    //als dat zo is zet ik dit de values van de post in mijn database ik gebruik mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action user_added zodat ik die kan gebruiken voor de message in de cms
    mysqli_query(
      $connection,
      "INSERT INTO categories 
    (name, description)
    values
    ('" .mysqli_real_escape_string($connection, $_POST['naamInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['beschrijvingInput']) . "')"
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=categories&action=category_added");
  } 
  else {
    //als ik wel een editId mee krijg zet ik dit de values van de post in mijn database met een update where id editId ik gebruik hier ook mysqli_real_escape_string zodat ik geen sql injectie krijg als er een error is heb ik die($connection) zodat ik een error message krijg daarna stuur ik de gebruiker terug met header(location) met daarin de action user_updated zodat ik die kan gebruiken voor de message in de cms
    mysqli_query(
      $connection,
      "UPDATE categories SET 
      name = '" .mysqli_real_escape_string($connection, $_POST['naamInput']) . "', 
      description = '".mysqli_real_escape_string($connection, $_POST['beschrijvingInput'])."'
      WHERE id = '".$_POST['editId']."' LIMIT 1
      "
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=categories&action=category_updated");
  }
}

//ik kijk hier of er een id is met get die zet ik in de $editId hiermee kan ik in mijn database kijken wat er allemaal al qua values instaan zodat het makkelijk aan te passen is als je op een artikel klik
if (array_key_exists('id', $_GET)) {
  $editId = $_GET['id'];
  //SQL query voor ophalen informatie
  $get_category = mysqli_query($connection, "SELECT * FROM categories WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));
  while ($category = mysqli_fetch_array($get_category)) {
    $naamInput = $category['name'];
    $beschrijvingInput = $category['description'];    
  }
} 
//als er geen editId is krijg je de lege values terug
else {
    $editId = "";
    $naamInput = "";
    $beschrijvingInput = "";
}


?>

<head>
  <link rel="stylesheet" href="toevoegen.css">
</head>
<a  href="?page=categories"><p class="terug"><- terug</p></a>
<form class="toevoeg-frm" action="cms.php?page=addcategory" method="post">
  <input type="hidden" name="categoryToevoegenForm" value="1">
  <input type="hidden" name="editId" value="<?= $editId; ?>">
  <table>
    <thead>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td colspan="2">
          <label for="naam">Wat is de naam van de categorie:</label>
          <input id="naam" type="text" name="naamInput" value="<?= $naamInput; ?>">
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <label for="beschrijving">beschrijving:</label>
          <input id="beschrijving" class="textinput" type="text" name="beschrijvingInput" value="<?= $beschrijvingInput; ?>">
        </td>
    </tbody>
  </table>
  <div class="button-center">
    <input class="button post-btn" value="post" type="submit">
  </div>
</form>