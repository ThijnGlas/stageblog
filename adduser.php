<?php
require_once("functions.php");
$connection = dbconnect("stageblog"); 

// check_login($_COOKIE['user_id'], $_COOKIE['session'], $_COOKIE['ip']);
 

if (isset($_POST['userToevoegenForm'])) {
  if (array_key_exists('editId', $_POST) && trim($_POST['editId']) == "") {
    mysqli_query(
      $connection,
      "INSERT INTO users 
    (username, password, voornaam, achternaam, email, role_id)
    values
    ('" .mysqli_real_escape_string($connection, $_POST['usernameInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['passwordInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['voornaamInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['achternaamInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['emailInput']) . "', 
    '" . mysqli_real_escape_string($connection, $_POST['role_idInput']) . "'
    )"
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=users&action=user_added");
  } 
  else {
    mysqli_query(
      $connection,
      "UPDATE users SET 
      username = '".mysqli_real_escape_string($connection, $_POST['usernameInput'])."', 
      password = '".mysqli_real_escape_string($connection, $_POST['passwordInput']) ."',
      voornaam = '".mysqli_real_escape_string($connection, $_POST['voornaamInput']) ."',
      achternaam = '".mysqli_real_escape_string($connection, $_POST['achternaamInput']) ."',
      email = '".mysqli_real_escape_string($connection, $_POST['emailInput']) ."',
      role_id = '".mysqli_real_escape_string($connection, $_POST['role_idInput']) ."' 
      WHERE id = '".$_POST['editId']."' LIMIT 1
      "
    ) or die(mysqli_error($connection));
    header("location: cms.php?page=users&action=user_updated");
  }
}


if (array_key_exists('id', $_GET)) {
  $editId = $_GET['id'];
  $get_user = mysqli_query($connection, "SELECT * FROM users WHERE id = '" . $editId . "' LIMIT 1") or die(mysqli_error($connection));
  while ($user = mysqli_fetch_array($get_user)) {
    $usernameInput = $user['username'];
    $passwordInput = $user['password'];
    $voornaamInput = $user['voornaam'];
    $achternaamInput = $user['achternaam'];
    $emailInput = $user['email'];
    $role_idInput = $user['role_id'];
    
  }
} else {
    $editId = "";
    $usernameInput = "";
    $passwordInput = "";
    $voornaamInput = "";
    $achternaamInput = "";
    $emailInput = "";
    $role_idInput = "";
}


?>

<head>
  <link rel="stylesheet" href="toevoegen.css">
</head>
<a  href="?page=users"><p class="terug"><- terug</p></a>
<form class="toevoeg-frm" action="cms.php?page=adduser" method="post">
  <input type="hidden" name="userToevoegenForm" value="1">
  <input type="hidden" name="editId" value="<?= $editId; ?>">
  <table>
    <thead>
      <th></th>
      <th></th>
    </thead>
    <tbody>
      <tr>
        <td>
          <label for="username">Wat is de gebruikersnaam:</label>
          <input id="username" type="text" name="usernameInput" value="<?= $usernameInput; ?>">
        </td>
        <td>
          <label for="password">Wat is het wachtwoord:</label>
          <input id="password" type="password" name="passwordInput" value="<?= $passwordInput; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="voornaam">voornaam:</label>
          <input id="voornaam" type="text" name="voornaamInput" value="<?= $voornaamInput; ?>">
        </td>
        <td>
          <label for="achternaam">achternaam:</label>
          <input id="achternaam" type="text" name="achternaamInput" value="<?= $achternaamInput; ?>">
        </td>
      </tr>
      <tr>
        <td>
          <label for="email">email:</label>
          <input id="email" type="email" name="emailInput" value="<?= $emailInput; ?>">
        </td>
        <td>
          <label for="role_id">role_id:</label>
          <input id="role_id" type="text" name="role_idInput" value="<?= $role_idInput; ?>">
        </td>
      </tr>
    </tbody>
  </table>
  <div class="button-center">
    <input class="button post-btn" value="post" type="submit">
  </div>
</form>