<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		<title>Wynajem pokoi</title>
		<link rel="stylesheet" href="stylg.css">
	</head>
	<body>
		<div id="header_g">
			<h3>Termin: <input type="text"> - <input type="text"> | Ilość miejsc: <input type="number"> | Kuchnia <input type="checkbox" value="1" name="kuchnia"> | Łazienka <input type="checkbox" value="1" name="lazienka"> | <input type="button" class="btn-rez" value="WYSZUKAJ"></h3>
		</div>
		<div id="main">
		<?php 
			$pol = mysqli_connect('localhost', 'root', '', 'projekt');
			
			$zap = "SELECT pokoj.numer, pokoj.nazwa, pokoj.opis, pokoj.lozko_poj, pokoj.lozko_pod, pokoj.dostawka, pokoj.lazienka, pokoj.balkon, pokoj.kuchnia, pokoj.pietro, galeria.sciezka, pokoj.ID, pokoj.cena FROM pokoj INNER JOIN galeria ON pokoj.ID = galeria.pokoj_ID WHERE galeria.awatar = 1";
			
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
				
				$poi = $w[3];
				$pod = 2 * $w[4];
				$miejsca = $poi + $pod;
				
				echo "<div class='wysw_g' id='".$w[11]."'> <img src=".$w[10]." width='100%'> <br><div class='wysw_t'> <h3>".$w[1]." </h3> <h4>Pokój nr. ".$w[0]." </h4> Ilość miejsc: ".$miejsca." <br> Cena za dobę: ".$w[12]." <br> 
				<form action='details.php' method='POST' target='_blank'><input type='hidden' name='identyfikator' value='".$w[11]."'><input type='submit' class='btn-ed' value='SZCZEGÓŁY'></form>
				<form action='rezerw.php' method='POST' target='_blank'><input type='hidden' name='identyfikator' value='".$w[11]."'><input type='submit' class='btn-ed' value='REZERWUJ'></form></div></div>";
			}
			
			mysqli_close($pol);
		?>
		
		</div>
	</body>
</html>