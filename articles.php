<?php
/*
if (isset($_POST['zoekenId'])) {
    $zoekId = mysqli_query($connection, "SELECT * FROM articles WHERE id = '" . $_POST['zoekenInput'] . "' LIMIT 1") or die(mysqli_error($connection));
    if (mysqli_num_rows($zoekId) == 1) {
        header("location: cms.php?page=toevoegen&id=" . $_POST['zoekenInput'] . "");
    } else {
        header("location: cms.php?page=articles&action=article_notfound");

    }
}
*/
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
            <th><a href="?page=toevoegen"><button class="toevoegen-btn button">toevoegen</button></a></th>
        </thead>
        <tbody>
            <?php 
            if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
                $articlesFromDatabase = mysqli_query($connection, "SELECT * FROM articles WHERE title LIKE '%".$_POST['zoekenInput']."%' OR id = '".$_POST['zoekenInput']."'") or die (mysqli_error($connection)); 
                if (mysqli_num_rows($articlesFromDatabase) == 0) {
                    header("location: cms.php?page=articles&action=article_notfound");
                }
            } else {
                $articlesFromDatabase = mysqli_query($connection, "SELECT * FROM articles");
            }

            while ($row = mysqli_fetch_array($articlesFromDatabase)) {
                echo "
                <tr>
                <td class=\"title\" colspan=\"2\">" . $row['title'] . "</h2>
                </td>
                <td class=\"center-nmbers\">" . $row['id'] . "</td>
                <td class=\"center-nmbers\">4321</td>
                <td class=\"buttons\">
                    <a href=\"?page=toevoegen&id=".$row['id']."\"><button class=\"button aanpassen-btn\">aanpassen</button></a>
                    <a href=\"?page=delete&id=".$row['id']."\"><button class=\"button verwijderen-btn\">verwijderen</button></a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>