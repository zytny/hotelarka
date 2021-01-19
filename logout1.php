<?php
session_start();
unset($_SESSION['user']);
session_destroy();
echo '<meta http-equiv="Refresh" content="0; URL=index.php">';
?>