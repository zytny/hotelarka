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
		<h1>Edycja pokoi</h1>
		
		<?php 
			$pol = mysqli_connect('localhost', 'root', '', 'projekt');
			
			$zap = "SELECT pokoj.numer, pokoj.nazwa, pokoj.opis, pokoj.lozko_poj, pokoj.lozko_pod, pokoj.dostawka, pokoj.lazienka, pokoj.balkon, pokoj.kuchnia, pokoj.pietro, galeria.sciezka FROM pokoj INNER JOIN galeria ON pokoj.ID = galeria.pokoj_ID WHERE galeria.awatar = 1";
			
			$wyn = mysqli_query($pol, $zap);
			
			while($w = mysqli_fetch_array($wyn)){
				
				if($w[5] == 0){
					$tmp1 = "x";
				} else {
					$tmp1 = "v";
				}
				
				if($w[6] == 0){
					$tmp2 = "x";
				} else {
					$tmp2 = "v";
				}
				
				if($w[7] == 0){
					$tmp3 = "x";
				} else {
					$tmp3 = "v";
				}
				
				if($w[8] == 0){
					$tmp4 = "x";
				} else {
					$tmp4 = "v";
				}
				
				echo "<div id='wysw'> <img src=".$w[10]." width='100%'> <br> <h4>Pokój nr. ".$w[0]." <br> ".$w[1]."</h4> Piętro: ".$w[9]." <p>".$w[2]."</p> <br> Łóżka jednoosobowe: ".$w[3]." <br> Łóżka dwuosobowe: ".$w[4]." <br> Dostawka: ".$tmp1." <br> Łazienka: ".$tmp2." <br> Balkon: ".$tmp3." <br> Kuchnia: ".$tmp4." <br> <input type='button' class='btn-ed' value='EDYTUJ'><input type='button' class='btn-ed' value='USUŃ'></div>";
			}
			
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