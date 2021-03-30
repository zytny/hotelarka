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
		<link rel="stylesheet" href="styld.css">
		
		<script>
			function validate(){
				var imie = document.getElementById('imie').value;
				var nazwisko = document.getElementById('nazwisko').value;
				var telefon = document.getElementById('telefon').value;
				var mail = document.getElementById('mail').value;
				var data1 = document.getElementById('datepicker1').value;
				var data2 = document.getElementById('datepicker2').value;
				var email_test = /^([A-Za-z0-9\-.]*\w)+@+([A-Za-z0-9\-.]*\w)+(\.[A-Za-z]*\w)+$/;
				var test_result = mail.match(email_test);
				
				
				if(imie.length < 3) {
					alert("Podano nieprawidłowe imię.");
					return false;
				} else if(nazwisko.length < 3) {
					alert("Podano nieprawidłowe nazwisko.");
					return false;
				} else if(telefon.length < 9 || telefon.length > 9) {
					alert("Podano nieprawidłowy numer.");
					return false;
				} else if(data1.length < 10 || data1.length > 10) {
					alert("Podano nieprawidłową datę.");
					return false;
				} else if(data2.length < 10 || data2.length > 10) {
					alert("Podano nieprawidłową datę.");
					return false;
				} else if(test_result == null){
					alert("Podano nieprawidłowy adres e-mail.");
					return false;
				} else {
					return true;
				}
			}
		</script>
	</head>
	<body>
		<div id="panel">
			<form method="POST" action="rezerwacja.php" onsubmit="return validate();">
			Imię:
			<input type="text" name="imie" class="inp" id="imie"><br>
			Nazwisko: 
			<input type="text" name="nazwisko" class="inp" id="nazwisko"><br>
			Numer telefonu: 
			<input type="number" name="telefon" class="inp" id="telefon"><br>
			E-mail: 
			<input type="text" name="mail" class="inp" id="mail"><br>
			Termin: <br>
			<input type="text" id="datepicker1" name="data1" class="dat"><input type="text" id="datepicker2" name="data2" class="dat">
			<?php
				$id = $_POST['identyfikator'];
				echo "<input type='hidden' name='pokoj' value='$id'>";
			?>
			<div id="lower">
			<br><input type="submit" value="REZERWUJ">
			</div>
			</form>
		</div>
		<script src="kal.js"></script>
	</body>