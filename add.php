<?php
	$pol = mysqli_connect('localhost', 'root', '', 'projekt');
	
	$nazwa = $_POST["nazwa"];
	$numer = $_POST["numer"];
	$pietro = $_POST["pietro"];
	$lozk1 = $_POST["lozk1"];
	$lozk2 = $_POST["lozk2"];
	$opis = $_POST["opis"];
	
	if(!isset($_POST["lazienka"])){
		$lazienka = 0;
	} else {
		$lazienka = $_POST["lazienka"];
	}
	
	if(!isset($_POST["kuchnia"])){
		$kuchnia = 0;
	} else {
		$kuchnia = $_POST["kuchnia"];
	}

	if(!isset($_POST["balkon"])){
		$balkon = 0;
	} else {
		$balkon = $_POST["balkon"];
	}
	
	if(!isset($_POST["dostawka"])){
		$dostawka = 0;
	} else {
		$dostawka = $_POST["dostawka"];
	}
	
	$zapytan = "INSERT INTO pokoj(numer, nazwa, opis, lozko_poj, lozko_pod, dostawka, lazienka, balkon, kuchnia, pietro) VALUES ('$numer', '$nazwa', '$opis', '$lozk1', '$lozk2', '$dostawka', '$lazienka', '$balkon', '$kuchnia', '$pietro')";
	
	mysqli_query($pol, $zapytan);
	
	echo '<meta http-equiv="Refresh" content="0; URL=utworz.php">';
	
	mysqli_close($pol);
?>