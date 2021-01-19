
<?php
session_start();
$pol = mysqli_connect('localhost', 'root', '', 'projekt');

$id = $_POST['identyfikator'];

$kwerenda = "DELETE FROM rezerwacja WHERE rezerwacja.ID = $id";

mysqli_query($pol, $kwerenda);

echo '<meta http-equiv="Refresh" content="0; URL=recepcja.php">';

mysqli_close($pol);
?>


