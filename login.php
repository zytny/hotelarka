<?php

require_once('db.php');

session_start();

if (!empty($_POST['login']) && !empty($_POST['password']))
{
    if ($_POST['login'] == USERNAME)
    {
        if (password_verify($_POST['password'], PASSWORD))
        {
            $_SESSION['user'] = htmlspecialchars($_POST['login']);  
        }
    }
}

?>

<meta http-equiv="Refresh" content="0; URL=edytuj.html">
