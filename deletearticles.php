<?php
//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog"); 

//via de get krijg ik een id mee die zet ik in een variable
$deleteId = $_GET['id'];

//ik kijk of er een post is van de delete form als dat zo is doe ik via een query de row met het $deleteid verwijderen daarna stuur ik hem terug naar de vorige pagina en geef een action message mee
if(isset($_POST['deleteArticle'])){
    mysqli_query($connection, "DELETE FROM articles WHERE id = ".$_GET['id']."");
    header("location: cms.php?page=articles&action=article_deleted");
}




?>

<div>
    <h2>weet u zeker dat u artikel:
        <?= $deleteId ?> wilt verwijderen?
    </h2>
    <form method="post" name="deleteArticle">
        <input type="hidden" name="deleteArticle" value="1">
        <input type="hidden" name="editId" value="<?= $deleteId; ?>">
        <input class="button" type="button" value="Cancel" onclick="window.location.href='?page=articles';"/>
        <input class="button btn-red" type="submit" value="verwijder">
    </form>
</div>