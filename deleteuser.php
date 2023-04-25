<?php
require_once("functions.php");
$connection = dbconnect("stageblog"); 

$deleteId = $_GET['id'];
$deleteuser = $_GET['username'];


if(isset($_POST['deleteArticle'])){
    mysqli_query($connection, "DELETE FROM users WHERE id = ".$_GET['id']."");
    header("location: cms.php?page=users&action=user_deleted");
}




?>

<div>
    <h2>weet u zeker dat u de gebruiker: 
        <?= $deleteuser ?> wilt verwijderen?
    </h2>
    <form method="post" name="deleteArticle">
        <input type="hidden" name="deleteArticle" value="1">
        <input type="hidden" name="editId" value="<?= $deleteId; ?>">
        <a href="?page=articles"><button class="button btn-red">terug</button></a>
        <input class="button btn-red" type="submit" value="verwijder">
    </form>
</div>