<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		<title>Recepcja</title>
		<link rel="stylesheet" href="style.css">
		<script>
			function clock(){
				var data = new Date();
				var godz = data.getHours();
				var min = data.getMinutes();
				var sec = data.getSeconds();
				var dzien = data.getDate();
				var mies = data.getMonth() + 1;
				var rok = data.getFullYear();
				
				if(godz<10) godz = "0" + godz;
				if(min<10) min = "0" + min;
				
				document.getElementById("show_clock").innerHTML = godz + ":" + min + "<br>" + dzien + "." + mies + "." + rok;
				
				setTimeout(clock, 1000);
			}
		</script>
	</head>
	<body onload="clock()">
		<div id="header">
			<div id="show_clock"> </div>
			<div id="user">Użytkownik</div>
		</div>
		<div id="menu">
			<h2>Menu</h2>
			<a href="recepcja.html"><input type="button" value="Rezerwacje"></a><br>
			<a href="utworz.html"><input type="button" value="Utwórz pokój"></a><br>
			<a href="edytuj.html"><input type="button" value="Edytuj pokój"></a><br>
			<a href="usun.html"><input type="button" value="Usuń pokój"></a><br>
			<a href="zmien.html"><input type="button" value="Zmień hasło"></a><br>
			<input type="button" value="Wyloguj"><br>
		</div>
		<div id="main">
			<h1>1</h1>
		</div>
		<div id="footer">
			<p>Projekt Hotelarka 2020</p>
		</div>
	</body>
</html>