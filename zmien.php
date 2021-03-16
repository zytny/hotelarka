<?php

session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		<title>Recepcja</title>
		<link rel="stylesheet" href="styl.css">
		<script>
			function clock(){
				var data = new Date();
				var godz = data.getHours();
				var min = data.getMinutes();
				var dzien = data.getDate();
				var mies = data.getMonth() + 1;
				var rok = data.getFullYear();
				
				if(godz<10) godz = "0" + godz;
				if(min<10) min = "0" + min;
				if(mies<10) mies = "0" + mies;
				if(dzien<10) dzien = "0" + dzien;
				
				document.getElementById("show_clock").innerHTML = godz + ":" + min + "<br>" + dzien + "." + mies + "." + rok;
				
				setTimeout(clock, 1000);
			}

			function validate(){
				var passw1= document.getElementById("passw1").value;
				var passw2= document.getElementById("passw2").value;
				var passchk = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
				
				if(passw1 == null || passw1 == "" || passw2 == null || passw2 == "") {
				alert("Proszę upewnić się, że wprowadzone są wymagane dane.");
				return false;
				} else {
					if(passw1.match(passchk)){
						if(passw1===passw2){
							alert("Hasło zostało zmienione.");
							return true;
						} else {
							alert("Podane hasła nie są zgodne.");
							return false;
						}
					} else {
						alert("Podane hasło nie spełnia wymagań. Między 8 - 15 znaków, przynajmniej 1 duża i 1 mała litera, 1 cyfra i 1 znak specjalny.");
						return false;
					}
				}	
			}
		</script>
	</head>
	<body onload="clock()">
	<?php if (!empty($_SESSION['user']))  : ?>
		<div id="menu">
			<h2>Menu</h2>
			<hr>
			<ul>
				<a href="recepcja.php"><li style="list-style-image: url('gui/domek.png')">Rezerwacje</li></a>
				<a href="utworz.php"><li style="list-style-image: url('gui/dodawanie.png')">Utwórz pokój</li></a>
				<a href="edytuj.php"><li style="list-style-image: url('gui/rezerwacje2.png')">Pokoje</li></a>
				<a href="zmien.php"><li style="list-style-image: url('gui/zmienhaslo.png')">Zmień hasło</li></a>
				<a href="logout.php"><li style="list-style-image: url('gui/wyloguj.png')">Wyloguj</li></a>
			</ul>
		</div>
		<div id="header">
			<div id="show_clock"> </div>
			<div id="user"><?php echo "<img src='gui/uzytkownik.png'>		" . $_SESSION['user']; ?></div>
		</div>
		<div id="main">
			<div id="h_1">
				<h1>Zmiana hasła</h1>
			</div>
			
			<br>
			<div id="panel">
			<form method="POST" action="passw_change.php" onsubmit="return validate();">
			<label for="passw1">Podaj nowe hasło: </label>
			<input type="password" name="passw1" id="passw1"><br>
			<label for="passw2">Powtórz nowe hasło: </label>
			<input type="password" name="passw2" id="passw2"><br>
			<div id="lower">
			<input type="submit" value="ZMIEŃ"> 
			<a class="lnk" href="create2.php" style="margin-left:35px;">Załóż konto recepcjonisty</a>
			</div>
			</form>
			</div>
		</div>
		
		<?php else : ?>
		
		<?php echo '<meta http-equiv="Refresh" content="0; URL=index.php">'; ?>
		
		<?php endif; ?>
		
	</body>
</html>