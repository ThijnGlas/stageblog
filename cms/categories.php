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
            <th class="links-text">categorie naam</th>
            <th>
                <form action="?page=categories" method="post">
                    <input class="id-zoek" name="zoekenInput" type="text" placeholder="zoeken met id of naam">
                    <input type="hidden" name="zoekenId" value="1">
                </form>
            </th>
            <th>ID</th>
            <th><a href="?page=addcategory"><button class="toevoegen-btn button">toevoegen</button></a></th>
        </thead>
        <tbody>
            <?php 
            //in deze if statement check ik of er een post en of de post niet leeg is            
            if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
                //in deze query kijk ik of er users zijn waarvan de naam of het id in de database staat als beide niet waar zijn krijg je een message met daarin user niet gevonden.
                $categoriesFromDatabase = mysqli_query($connection, "SELECT * FROM categories WHERE name LIKE '%".$_POST['zoekenInput']."%' OR id = '".$_POST['zoekenInput']."'") or die (mysqli_error($connection)); 
                if (mysqli_num_rows($categoriesFromDatabase) == 0) {
                    header("location: cms.php?page=categories&action=category_notfound");
                }
            } else {
                //als er niks is ingetypt krijg je alle users te zien                
                $categoriesFromDatabase = mysqli_query($connection, "SELECT * FROM categories");
            }
            //met deze while krijg ik alle users uit de database in een tabel. 
            while ($row = mysqli_fetch_array($categoriesFromDatabase)) {
                echo "
                <tr>
                <td class=\"title\" colspan=\"2\">" . $row['name'] . "</h2>
                </td>
                <td class=\"center-nmbers\">" . $row['id'] . "</td>
                <td class=\"buttons\">
                    <a href=\"?page=addcategory&id=".$row['id']."\"><button class=\"button aanpassen-btn\">aanpassen</button></a>
                    <a href=\"?page=deletecategory&id=".$row['id']."&name=".$row['name']."\"><button class=\"button verwijderen-btn\">verwijderen</button></a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>