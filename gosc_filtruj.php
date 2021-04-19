<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		
		<link rel="stylesheet" type="text/css" href="lightpick.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
		<script src="lightpick.js"></script>
		
		<title>Wynajem pokoi</title>
		<link rel="stylesheet" href="stylg.css">
		<script>	
		var wyczyszczono = false;
		
			function porownanie(){
				var ilosc = document.getElementById("ilosc").value;
				var pokoje = {};
				var chekd = 0;
				
				for(var i = 1; i <= ilosc; i++){
					var pokoj = document.getElementById("chk"+i);
					if(pokoj.checked == 1){
						pokoje[i] = {id:pokoj.value};
						chekd++;
					}
				}
				
				document.getElementById("pok").innerHTML = JSON.stringify(pokoje);
				
				if(chekd <= 1){
					alert("Proszę zaznaczyć przynajmniej dwa pokoje do porównania.");
					return false;
				}
			}
			
			function spr_daty(d1, d2, data){
				if(data <= d2 && data >= d1){
					return true;
				} 
				return false;
			}
			
			function filtr(){
				var main = document.getElementById("main");
				var pokoje = main.childNodes;
				
				var d1 = document.getElementById("datepicker1").value;
				d1 = new Date(d1);
				var d2 = document.getElementById("datepicker2").value;
				d2 = new Date(d2);
				var miejsca = document.getElementById("miejsca").value;
				var kuchnia = document.getElementById("kuchnia").checked;
				var lazienka = document.getElementById("lazienka").checked;
				var dostawka = document.getElementById("dostawka").checked;
				var balkon = document.getElementById("balkon").checked;
				
				if(!wyczyszczono){
					pokoje[0].remove();
					pokoje[pokoje.length-1].remove();
					wyczyszczono = true;
				}
				
				pokoje.forEach(pokoj => {
					if(pokoj != pokoje[pokoje.length-1]){
						var pok_miejsca = pokoj.childNodes[4].childNodes[5].getAttribute("value");
						var pok_cena = pokoj.childNodes[4].childNodes[9].getAttribute("value");
						var pok_dostawka = pokoj.childNodes[4].childNodes[13].getAttribute("value");
						var pok_lazienka = pokoj.childNodes[4].childNodes[14].getAttribute("value");
						var pok_balkon = pokoj.childNodes[4].childNodes[15].getAttribute("value");
						var pok_kuchnia = pokoj.childNodes[4].childNodes[16].getAttribute("value");
						var pok_terminy = pokoj.childNodes[4].childNodes[17].textContent;
						pokoj.hidden = true;
						
						//sprawdzanie po dacie
						if(d1 != '' && d2 != ''){
							var rezerwacje = JSON.parse(pok_terminy);
							if(rezerwacje.length > 0){
								var kolizja_terminow = false;
								rezerwacje.forEach(termin => {
									var data_od = new Date(termin['data_od']);
									var data_do = new Date(termin['data_do'])
									if(spr_daty(data_od, data_do, d1) || spr_daty(data_od, data_do, d2)){
										kolizja_terminow = true;
									}
								})
								if(!kolizja_terminow){
									pokoj.hidden = false;
								}
							}else if(rezerwacje.length == 0){
								pokoj.hidden = false;
							}
							
						}
						
						//Sprawdzanie po ilości miejsc
						if(miejsca > 0){
							if(pok_miejsca != miejsca){
								pokoj.hidden = true;
							}
						}
						
						//Sprawdzanie po udogodnieniach
						if(kuchnia > 0){
							if(pok_kuchnia != kuchnia){
								pokoj.hidden = true;
							}
						}
						if(lazienka > 0){
							if(pok_lazienka != lazienka){
								pokoj.hidden = true;
							}
						}
						if(balkon > 0){
							if(pok_balkon != balkon){
								pokoj.hidden = true;
							}
						}
						if(dostawka > 0){
							if(pok_dostawka != dostawka){
								pokoj.hidden = true;
							}
						}
					}
				});
			}
		</script>
	</head>
	<body>
		<div id="header_g">
			<h3><form>Termin: <input type="text" id="datepicker1" name="data1" class="dat"> - <input type="text" id="datepicker2" name="data2" class="dat"> | Ilość miejsc: <input type="number" id="miejsca"> 
			| Kuchnia <input type="checkbox" value="1" id="kuchnia"> | Łazienka <input type="checkbox" value="1" id="lazienka"> 
			| Dostawka <input type="checkbox" value="1" id="dostawka"> | Balkon <input type="checkbox" value="1" id="balkon">
			<input type="reset" class="btn-rez" value="WYCZYŚĆ">
			<input type="button" class="btn-rez" value="FILTRUJ" onclick="filtr()"></form></h3>
			<form id="por" name="por" action="comparison.php" method="POST" target="_blank" onsubmit="return porownanie();">
			<textarea method="POST" form="por" hidden id="pok" name="pok"></textarea>
			<input type="submit" class="btn-rez" value="PORÓWNAJ">
			</form>
		</div>
		<div id="main">
		<?php 
			$pol = mysqli_connect('localhost', 'root', '', 'projekt');
			
			$zap = "SELECT pokoj.numer, pokoj.nazwa, pokoj.opis, pokoj.lozko_poj, pokoj.lozko_pod, pokoj.dostawka, pokoj.lazienka, pokoj.balkon, pokoj.kuchnia, pokoj.pietro, galeria.sciezka, pokoj.ID, pokoj.cena FROM pokoj INNER JOIN galeria ON pokoj.ID = galeria.pokoj_ID WHERE galeria.awatar = 1";
			
			$wyn = mysqli_query($pol, $zap);
			
			$num = 1;
			
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
				
				$tab_rez = array();
				$row_temp= array();
				
				$rez = mysqli_query($pol, "SELECT data_od, data_do FROM rezerwacja WHERE pokoj_ID = $w[11] AND przestarzale = 0");
				while($row = mysqli_fetch_array($rez, MYSQLI_ASSOC)){
					$row_temp['data_od'] = $row['data_od'];
					$row_temp['data_do'] = $row['data_do'];
					$tab_rez[] = $row_temp;
				}
				
				
				echo "<div class='wysw_g' id='".$w[11]."'> <img src=".$w[10]." width='100%'> <br><div class='wysw_t'> <h3>".$w[1]." </h3> <h4>Pokój nr. ".$w[0]." </h4> <font value=".$miejsca.">Ilość miejsc: ".$miejsca."</font> <br> <font value=".$w[12].">Cena za dobę: ".$w[12]."</font> <br>
				<input hidden name='pok_dostawka' value='$w[5]'><input hidden name='pok_lazienka' value='$w[6]'><input hidden name='pok_balkon' value='$w[7]'><input hidden name='pok_kuchnia' value='$w[8]'><textarea hidden name='pok_rezerwacja'>".json_encode($tab_rez)."</textarea>
				<form action='details.php' method='POST' target='_blank'><input type='hidden' name='identyfikator' value='".$w[11]."'><input type='submit' class='btn-ed' value='SZCZEGÓŁY'></form>
				<form action='rezerw.php' method='POST' target='_blank'><input type='hidden' name='identyfikator' value='".$w[11]."'><input type='submit' class='btn-ed' value='REZERWUJ'></form>
				<input type='checkbox' id='chk".$num."' name='chk".$num."' value='".$w[11]."'>Porównanie</div></div>";
				
				$num++;
			}
			
			$num--;
			echo "<input id='ilosc' type='hidden' value=".$num.">";
			
			mysqli_close($pol);
		?>
		<script src="kal.js"></script>
		</div>
	</body>
</html>