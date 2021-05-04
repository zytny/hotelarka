<?php
session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		<title>Szczegóły pokoju</title>
		<link rel="stylesheet" href="styld.css">
	</head>
	<body id="d">
	<div id="panel_det">
		<?php
		$pol = mysqli_connect('localhost', 'root', '', 'projekt');

		$id = $_POST['identyfikator'];
		
		$zap = "SELECT numer, 
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
		
		$zap2 = "SELECT sciezka FROM galeria WHERE pokoj_ID = $id AND awatar = 1";
		
		$zap3 = "SELECT sciezka FROM galeria WHERE pokoj_ID = $id AND awatar = 0";
		
		$wyn = mysqli_query($pol, $zap);
		$wyn2 = mysqli_query($pol, $zap2);
		$wyn3 = mysqli_query($pol, $zap3);
		
		$r1 = mysqli_fetch_array($wyn);
		$r2 = mysqli_fetch_array($wyn2);
		
			//Dostawka
				if($r1[5] == 0){
					$tmp1 = "Nie";
				} else {
					$tmp1 = "Tak";
				}
			//Łazienka
				if($r1[6] == 0){
					$tmp2 = "Nie";
				} else {
					$tmp2 = "Tak";
				}
			//Balkon
				if($r1[7] == 0){
					$tmp3 = "Nie";
				} else {
					$tmp3 = "Tak";
				}
			//Kuchnia
				if($r1[8] == 0){
					$tmp4 = "Nie";
				} else {
					$tmp4 = "Tak";
				}
		
		echo "
			<h2>".$r1[1]."</h2><br>
			<img id='mf' src=".$r2[0]."><br>
			<h4>Pokój nr. ".$r1[0]."</h4>
			Piętro: ".$r1[9]."<br>
			Cena za dobę: ".$r1[10]." zł<br>
			<p>".$r1[2]."</p>
			Łóżka pojedyncze: ".$r1[3]."<br>
			Łóżka podwójne: ".$r1[4]."<br>
			Dostawka: ".$tmp1."<br>
			Łazienka: ".$tmp2."<br>
			Balkon: ".$tmp3."<br>
			Kuchnia: ".$tmp4."<br><br>
			<form action='rezerw.php' method='POST' target='_blank'>
			<input type='hidden' name='identyfikator' value='".$id."'>
			<input type='submit' class='btn-ed' value='REZERWUJ'>
			</form><br><br>
		";
		
		while($r3 = mysqli_fetch_array($wyn3)){
			echo "
				<a href='$r3[0]' target='_blank'><img class='szczeg_zdj' src='$r3[0]'></a>
			";
		}


		mysqli_close($pol);
		?>
	</div>
	</body>
</html>
