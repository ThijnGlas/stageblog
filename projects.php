<?php

//hier haal ik een functie op die ik gebruik om een database connectie te maken
require_once("functions.php");

 //hier zet ik de dbconnect functie in een $connention variable dit doe ik zodat ik hem makkelijk kan oproepen
$connection = dbconnect("stageblog"); 

?>

<head>
    <link rel="stylesheet" href="artikels.css">
</head>

<div class="content">
    <table>
        <thead class="head-tbl">
            <th class="links-text">Artikel naam</th>
            <th>
                <form action="?page=articles" method="post">
                    <input class="id-zoek" name="zoekenInput" type="text" placeholder="zoeken met id">
                    <input type="hidden" name="zoekenId" value="1">
                </form>
            </th>
            <th>ID</th>
            <th>Keer bekeken</th>
            <th><a href="?page=addarticles"><button class="toevoegen-btn button">toevoegen</button></a></th>
        </thead>
        <tbody>
            <?php 
            //in deze if statement check ik of er een post en of de post niet leeg is
            if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
                //in deze query kijk ik of er articles zijn de of het in de titel staat en of er een id van is als beide niet waar zijn krijg je een message met daarin artikel niet gevonden.
                $articlesFromDatabase = mysqli_query($connection, "SELECT * FROM articles WHERE title LIKE '%".$_POST['zoekenInput']."%' OR id = '".$_POST['zoekenInput']."'") or die (mysqli_error($connection)); 
                if (mysqli_num_rows($articlesFromDatabase) == 0) {
                    header("location: cms.php?page=articles&action=article_notfound");
                }
            } else {
                //als er niks is ingetypt krijg je alle artikels te zien
                $articlesFromDatabase = mysqli_query($connection, "SELECT * FROM articles");
            }
            //met deze while krijg ik alle artikels uit de database in een tabel. 
            while ($row = mysqli_fetch_array($articlesFromDatabase)) {
                echo "
                <tr>
                <td class=\"title\" colspan=\"2\">" . $row['title'] . "</h2>
                </td>
                <td class=\"center-nmbers\">" . $row['id'] . "</td>
                <td class=\"center-nmbers\">4321</td>
                <td class=\"buttons\">
                    <a href=\"?page=addarticles&id=".$row['id']."\"><button class=\"button aanpassen-btn\">aanpassen</button></a>
                    <a href=\"?page=deletearticles&id=".$row['id']."\"><button class=\"button verwijderen-btn\">verwijderen</button></a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>