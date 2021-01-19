<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		
		<link rel="stylesheet" type="text/css" href="lightpick.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
		<script src="lightpick.js"></script>
		
		
		<title>Recepcja</title>
		<link rel="stylesheet" href="styl.css">
	</head>
	<body>
		<form method="POST" action="rezerwacja.php">
		Imię: <input type="text" name="imie"><br>
		Nazwisko: <input type="text" name="nazwisko"><br>
		Numer telefonu: <input type="number" name="telefon"><br>
		E-mail: <input type="text" name="mail"><br>
		Termin: <input type="text" id="datepicker1" name="data1"><input type="text" id="datepicker2" name="data2">
		<?php
			$id = $_POST['identyfikator'];
			echo "<input type='hidden' name='pokoj' value='$id'>"
		?>
		<br><input type="submit" value="REZERWUJ">
		</form>
		<script src="kal.js"></script>
	</body>