<?php

session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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
				var cena= document.getElementById("cena").value;
				var nazwa= document.getElementById("nazwa").value;
				var lozk1= document.getElementById("lozk1").value;
				var lozk2= document.getElementById("lozk2").value;
				var pietro= document.getElementById("pietro").value;
				
				if(nazwa == null || nazwa == "" || lozk1 == null || lozk1 == "" || lozk2 == null || lozk2 == "" || pietro == null || pietro == "" || cena == "" || cena == null ) {
				alert("Proszę upewnić się, że wprowadzone są wymagane dane.");
				return false;
				} else {
					lozk1 = parseInt(lozk1);
					lozk2 = parseInt(lozk2);
					
					if(pietro < -2){
						alert("Wprowadzono nieprawidłowe piętro.");
						return false;

					} else {
						if(lozk1 < 0 || lozk2 < 0 || lozk1 + lozk2 <= 0){
							alert("W pokoju musi znajdować się przynajmniej jedno łóżko.");
							return false;
						} else if(lozk1 + lozk2 > 10) {
							alert("W pokoju nie może znajdować się więcej niż 10 łóżek.");
							return false;
						} else {
							return true;
						}
					}
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
		
			<?php
				$pol = mysqli_connect('localhost', 'root', '', 'projekt');
				$id = $_POST['identyfikator'];
				
				$zapytanie = "SELECT numer, 
				nazwa, 
				opis, 
				lozko_poj, 
				lozko_pod, 
				dostawka, 
				lazienka, 
				balkon, 
				kuchnia, 
				pietro, 
				cena  
				FROM pokoj 
				WHERE ID = $id";
				
				$zapytanie2 = "SELECT sciezka, id FROM galeria WHERE pokoj_ID = $id AND awatar = 1";
				
				$wynik = mysqli_query($pol, $zapytanie);
				$wynik2 = mysqli_query($pol, $zapytanie2);
				
				$arr = mysqli_fetch_array($wynik);
				$arr2 = mysqli_fetch_array($wynik2);
				
				if($arr[5] == 0){
					$z5 = "";
				} else {
					$z5 = "checked";
				}
				
				if($arr[6] == 0){
					$z6 = "";
				} else {
					$z6 = "checked";
				}
				
				if($arr[7] == 0){
					$z7 = "";
				} else {
					$z7 = "checked";
				} 
				
				if($arr[8] == 0){
					$z8 = "";
				} else {
					$z8 = "checked";
				}
				
				echo "
				<form method='POST' action='change.php' id='dodawanie' onsubmit='return validate();' enctype='multipart/form-data'>
				<input type='hidden' value='$arr2[1]' name='id_aw'>
				<input type='hidden' value='$arr2[0]' name='sciezka_aw'>
				<input type='hidden' value='$id' name='id_pok'>
				Nazwa pokoju: <input type='text' name='nazwa' id='nazwa' value='$arr[1]'> <br>
				<div id='num_dod'>
				Numer: <input type='number' name='numer' class='numeryczne' value='$arr[0]'> Piętro: <input type='number' name='pietro' id='pietro' class='numeryczne' value='$arr[9]'><br>
				Łóżka 1-os: <input type='number' name='lozk1' id='lozk1' class='numeryczne' value='$arr[3]'> Łóżka 2-os: <input type='number' name='lozk2' id='lozk2' class='numeryczne' value='$arr[4]'><br>
				</div>
				Opis <br>
				<textarea maxlength='500' placeholder='Opcjonalne' rows='13' cols='45' name='opis' id='opis'>$arr[2]</textarea><br>
				Cena za dobę: <input type='number' id='cena' name='cena' value='$arr[10]'> zł
				<div id='chck_dod'>
				<input type='checkbox' value='1' name='lazienka' $z6> Łazienka <input type='checkbox' value='1' name='kuchnia' $z8> Kuchnia <br>
				<input type='checkbox' value='1' name='balkon' $z7> Balkon <input type='checkbox' value='1' name='dostawka' $z5> Dostawka <br>
				</div>
				Awatar: <input type='file' value='Dodaj awatar' id='av_upl' name='awatar'> <br> Zdjęcia: <input type='file' id='zdjecia_pok' value='Dodaj zdjęcia' name='zdjecie[]' multiple=''><br><br>
				<input type='reset' value='Wyczyść'> <input type='submit' value='Zmień'>
				</form>
				
				<div id='zdjecia'>
				<img class='zdj' id='av' src='$arr2[0]' width='150px' height='100px'> <br> <hr>
				<div id='pic'>
				</div>
				</div>
				";

				mysqli_close($pol);
			?>
		
			
			
			
		</div>
		
		<?php else : ?>
		
		<?php echo '<meta http-equiv="Refresh" content="0; URL=index.php">'; ?>
		
		<?php endif; ?>
		
		<div id="footer">
			<p>Projekt Hotelarka 2020</p>
		</div>
		<script src="zdj.js" type="text/javascript"></script>
	</body>
</html>