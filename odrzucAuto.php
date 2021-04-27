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
			
			function wr(){
				window.location.assign("recepcja.php");
			}
			
			function validate(){
				var powod = document.getElementById('powod').value;
				
				if(powod == null || powod == ""){
					alert("Prosimy podać powód odrzucenia rezerwacji.");
					return false;
				}
				
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
		
			<form method="POST" action="odrzuc2.php" onsubmit="return validate();">
			<h3>Czy na pewno chcesz odrzucić rezerwację?</h3>
			<br>
			<?php
			$id = $_POST['identyfikator'];
			$mail = $_POST['mail'];
			echo "<input type='hidden' value='$id' name='identyfikator'>
			<input type='hidden' value='$mail' name='mail'>
			<input type='hidden' value='Odrzucenie rezerwacji' name='temat'>";
			?>
			Powód: <input type="text" name="powod" id="powod">
			<br><br>
			<input type="submit" value="Tak"><input type="reset" value="Nie" onclick="wr();">
			</form>
			
		</div>
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php else : ?>
		
		<?php echo '<meta http-equiv="Refresh" content="0; URL=index.php">'; ?>
		
		<?php endif; ?>
	</body>
</html>