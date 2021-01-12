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
		</script>
	</head>
	<body onload="clock()">
	<?php if (!empty($_SESSION['user'])) : ?>
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
			<h2>Rezerwacje</h2>
			
			<?php 
				$pol = mysqli_connect('localhost', 'root', '', 'projekt');
				
				$zap = "SELECT rezerwacja.ID, rezerwacja.potwierdzenie, rezerwacja.data_do, rezerwacja.data_do, rezerwacja.pokoj_ID, pokoj.numer, klient.imie, klient.nazwisko, klient.numer_tel FROM rezerwacja INNER JOIN pokoj ON rezerwacja.pokoj_ID = pokoj.ID INNER JOIN klient ON rezerwacja.klient_ID = klient.ID";
			
				$wyn = mysqli_query($pol, $zap);
					echo "<ul>";
					
				while($w = mysqli_fetch_array($wyn)){
					echo "<li class='rezerw'> Pokój nr:".$w[5]." | Klient: ".$w[6]." ".$w[7]." | <input type='button' value='POTWIERDŹ' class='btn-rez'> <input type='button' value='ODRZUĆ' class='btn-rez'></li>";
				}
				
				echo "</ul>";
				
				mysqli_close($pol);
			?>
			
		</div>
		<?php else : ?>
		
		<?php echo '<meta http-equiv="Refresh" content="0; URL=index.php">'; ?>
		
		<?php endif; ?>
		<div id="footer">
			<p>Projekt Hotelarka 2020</p>
		</div>
	</body>
</html>