
<?php
session_start();
$pol = mysqli_connect('localhost', 'root', '', 'projekt');

$id = $_POST['identyfikator'];

$kwerenda = "DELETE FROM pokoj WHERE pokoj.ID = $id";

mysqli_query($pol, $kwerenda);

echo '<meta http-equiv="Refresh" content="0; URL=edytuj.php">';

mysqli_close($pol);
?>