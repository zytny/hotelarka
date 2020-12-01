
<?php
session_start();
$pol = mysqli_connect('localhost', 'root', '', 'projekt');

$login= $_POST['username'];
$pass= $_POST['password'];
$pass= md5($pass);

$zap = mysqli_query($pol, "SELECT * FROM recepcjonista");

while($wiersz = mysqli_fetch_row($zap)){
	if($wiersz[1]==$login && $wiersz[2]==$pass){
		$username = $login;
		$password = $pass;
	}
}

if (!empty($username) && !empty($password))
{
    if ($_POST['username'] == $username)
    {
        if (md5($_POST['password'])== $password)
        {
            $_SESSION['user'] = $login;  
            echo '<meta http-equiv="Refresh" content="0; URL=recepcja.php">';
        }else{
            echo '<meta http-equiv="Refresh" content="0; URL=index.php">';
		}
    }else{
		echo '<meta http-equiv="Refresh" content="0; URL=index.php">';
	}
}else{
    echo '<meta http-equiv="Refresh" content="0; URL=index.php">';
}
mysqli_close($pol);
?>



