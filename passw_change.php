<?php
session_start();
$pol = mysqli_connect('localhost', 'root', '', 'projekt');

$passwd = $_POST['passw1'];
$passw = md5($passwd);
$user = $_SESSION['user'];

$kwerenda = "UPDATE recepcjonista SET haslo = '$passw' WHERE login = '$user'";

mysqli_query($pol, $kwerenda);

header('Location: zmien.php');

mysqli_close($pol);
?>

