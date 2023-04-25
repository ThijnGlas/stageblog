<?php

?>

<head>
    <link rel="stylesheet" href="artikels.css">
</head>

<div class="content">
    <table>
        <thead class="head-tbl">
            <th class="links-text">gebruikersnaam</th>
            <th>
                <form action="?page=berichten" method="post">
                    <input class="id-zoek" name="zoekenInput" type="text" placeholder="zoeken met id">
                    <input type="hidden" name="zoekenId" value="1">
                </form>
            </th>
            <th>ID</th>
            <th class="links-text">naam</th>
            <th><a href="?page=toevoegenusers"><button class="toevoegen-btn button">toevoegen</button></a></th>
        </thead>
        <tbody>
            <?php 
            if(isset($_POST['zoekenInput']) && trim($_POST['zoekenInput']) != ""){ 
                $usersFromDatabase = mysqli_query($connection, "SELECT * FROM users WHERE title LIKE '%".$_POST['zoekenInput']."%' OR id = '".$_POST['zoekenInput']."'") or die (mysqli_error($connection)); 
                if (mysqli_num_rows($usersFromDatabase) == 0) {
                    header("location: cms.php?page=users&action=user_notfound");
                }
            } else {
                $usersFromDatabase = mysqli_query($connection, "SELECT * FROM users");
            }

            while ($row = mysqli_fetch_array($usersFromDatabase)) {
                echo "
                <tr>
                <td class=\"title\" colspan=\"2\">" . $row['username'] . "</h2>
                </td>
                <td class=\"center-nmbers\">" . $row['id'] . "</td>
                <td class=\"center-nmbers\">" . $row['voornaam'] . " ".$row['achternaam']."</td>
                <td class=\"buttons\">
                    <a href=\"?page=toevoegen-users&id=".$row['id']."\"><button class=\"button aanpassen-btn\">aanpassen</button></a>
                    <a href=\"?page=delete-users&id=".$row['id']."\"><button class=\"button verwijderen-btn\">verwijderen</button></a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>