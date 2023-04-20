<?php

function dbconnect($database)
{

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    
    $connection = mysqli_connect($db_server, $db_username, $db_password);
    mysqli_select_db($connection, $database);
    return $connection; 

}

function check_login($user_id, $session, $ipv4)
{ 
    $dbconnection = dbconnect("stageblog");
    $check_login = mysqli_query($dbconnection, "SELECT * FROM users WHERE id = '".$user_id."' AND session = '".$session."' AND ipv4 = '".$ipv4."' LIMIT 1"); 
    if(mysqli_num_rows($check_login) == 1)
    {
        $session = getRandomString();
        setcookie("session", $session);
        mysqli_query($dbconnection, "UPDATE users SET session = '".$session."' WHERE id = '".$user_id."'");
    } else {

        header("location: index.php");
        exit; 

    }

}


function getRandomString()
{
    $n = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}