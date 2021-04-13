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
	<body id="comp">
	
		<?php
		$pol = mysqli_connect('localhost', 'root', '', 'projekt');
		

		$pokoje = json_decode($_POST['pok'],true);
		
		foreach($pokoje as $pokoj_key=>$pokoj_value){
			$id = 0;
			
			foreach($pokoj_value as $key=>$value){
				if($key == 'id'){
					$id = $value;
				}
			}
			
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
			
			$wyn1 = mysqli_query($pol, $zap);
			$wyn2 = mysqli_query($pol, $zap2);
			
			$r1 = mysqli_fetch_array($wyn1);
			$r2 = mysqli_fetch_array($wyn2);
			
			//Dostawka
				if($r1[5] == 0){
					$tmp1 = "x.png";
				} else {
					$tmp1 = "v.png";
				}
			//Łazienka
				if($r1[6] == 0){
					$tmp2 = "x.png";
				} else {
					$tmp2 = "v.png";
				}
			//Balkon
				if($r1[7] == 0){
					$tmp3 = "x.png";
				} else {
					$tmp3 = "v.png";
				}
			//Kuchnia
				if($r1[8] == 0){
					$tmp4 = "x.png";
				} else {
					$tmp4 = "v.png";
				}
		
		echo "
		<div class='panel_det2'>
			<h2>".$r1[1]."</h2><br>
			<img id='mf' src=".$r2[0]."><br>
			<h4>Pokój nr. ".$r1[0]."</h4>
			<hr>
			Piętro: ".$r1[9]."<br>
			<hr>
			Cena za dobę: ".$r1[10]." zł<br>
			<hr>
			<p class='desc'>".$r1[2]."</p>
			<hr>
			Łóżka pojedyncze: ".$r1[3]."<br>
			<hr>
			Łóżka podwójne: ".$r1[4]."<br>
			<hr>
			Dostawka: <img class='yn' src='gui/".$tmp1."'><br>
			<hr>
			Łazienka: <img class='yn' src='gui/".$tmp2."'><br>
			<hr>
			Balkon: <img class='yn' src='gui/".$tmp3."'><br>
			<hr>
			Kuchnia: <img class='yn' src='gui/".$tmp4."'><br><br>
			<form action='rezerw.php' method='POST' target='_blank'>
			<input type='hidden' name='identyfikator' value='".$id."'>
			<input type='submit' class='btn-ed' value='REZERWUJ'>
			</form><br><br></div>";
		}
		mysqli_close($pol);
		?>
	
	</body>
</html>
