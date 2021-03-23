<?php
	$pol = mysqli_connect('localhost', 'root', '', 'projekt');
	$sciezka = $_POST["sciezka_aw"];
	$aw = $_POST["id_aw"];
	$id = $_POST["id_pok"];
	$nazwa = $_POST["nazwa"];
	$numer = $_POST["numer"];
	$pietro = $_POST["pietro"];
	$lozk1 = $_POST["lozk1"];
	$lozk2 = $_POST["lozk2"];
	$opis = $_POST["opis"];
	$cena = $_POST["cena"];
	
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
	
	$aw_del = "DELETE FROM galeria WHERE id = $aw";
	
	$zdj_get = "SELECT sciezka FROM galeria WHERE pokoj_ID = $id AND awatar = 0";
	
	$zdj_del = "DELETE FROM galeria WHERE pokoj_ID = $id AND awatar = 0";
	
	$zapytan = "UPDATE pokoj SET numer=$numer, 
	nazwa='$nazwa', 
	opis='$opis', 
	lozko_poj=$lozk1,
	lozko_pod=$lozk2, 
	dostawka=$dostawka, 
	lazienka=$lazienka, 
	balkon=$balkon, 
	kuchnia=$kuchnia,
	pietro=$pietro, 
	cena=$cena 
	WHERE ID = $id";
	
	$test = "SELECT count(ID) FROM pokoj WHERE (nazwa = '$nazwa' OR numer = '$numer') AND ID != '$id'";
	
	$test_wynik = mysqli_query($pol, $test);
	
	while($test_wybor = mysqli_fetch_row($test_wynik)){
		if($test_wybor[0] == '0'){
	
			mysqli_query($pol, $zapytan);
			
			$id_check = "SELECT id FROM pokoj WHERE numer = '$numer' AND nazwa = '$nazwa'";
			
			$id_get = mysqli_query($pol, $id_check);
			
			$id_get2 = mysqli_fetch_array($id_get);
			
			
			if(is_uploaded_file($_FILES['awatar']['tmp_name'])){
				
				mysqli_query($pol, $aw_del);
				unlink($sciezka);
			
				$plik = $_FILES['awatar'];
				
				$plikNazwa = $plik['name'];
				$plikTyp = $plik['type'];
				$plikTmp = $plik['tmp_name'];
				$plikBlad = $plik['error'];
				$plikRoz = $plik['size'];
				
				$plikExt = explode('.', $plikNazwa);
				$plikExt2 = strtolower(end($plikExt));
				
				$zezwolone = array('jpg', 'jpeg', 'png');
				
				if(in_array($plikExt2, $zezwolone)){
					if($plikBlad === 0){
						if($plikRoz < 150000000){
							$plikNowy = uniqid('', true).".".$plikExt2;
							$plikCel = 'pic/'.$plikNowy;
							
							move_uploaded_file($plikTmp, $plikCel);
							
							$sql_aw = "INSERT INTO galeria (pokoj_ID, awatar, nazwa, sciezka) VALUES ('$id_get2[0]', '1', '$plikNowy', '$plikCel')";
							mysqli_query($pol, $sql_aw);
						} else {
							// Plik za duży
						}
					} else {
						// Błąd wczytywania pliku
					}
				} else {
					// Zły format pliku
				}
			}
			
			if(isset($_FILES['zdjecie'])){
				

				
				$tab = $_FILES['zdjecie'];
				
				$tabela = array();
				$tabela_licz = count($tab['name']);
				$tabela_klucze = array_keys($tab);	
				
				if($tabela_licz > 1){
					$zdj_unlink = mysqli_query($pol, $zdj_get);
				
					while($sciezk = mysqli_fetch_row($zdj_unlink)){
						unlink($sciezk[0]);
						}
				
					mysqli_query($pol, $zdj_del);
				}
				
				echo $tabela_licz;
				
				for ($i=0; $i<$tabela_licz; $i++){
					foreach($tabela_klucze as $klucz){
						$tabela[$i][$klucz] = $tab[$klucz][$i];
					}
				}
				
				
				foreach($tabela as $plik){
				
					$plikNazwa = $plik['name'];
					$plikTyp = $plik['type'];
					$plikTmp = $plik['tmp_name'];
					$plikBlad = $plik['error'];
					$plikRoz = $plik['size'];
					
					$plikExt = explode('.', $plikNazwa);
					$plikExt2 = strtolower(end($plikExt));
					
					$zezwolone = array('jpg', 'jpeg', 'png');
					
					if(in_array($plikExt2, $zezwolone)){
						if($plikBlad === 0){
							if($plikRoz < 150000000){
								$plikNowy = uniqid('', true).".".$plikExt2;
								$plikCel = 'pic/'.$plikNowy;
								
								move_uploaded_file($plikTmp, $plikCel);
								
								$sql_zd = "INSERT INTO galeria (pokoj_ID, awatar, nazwa, sciezka) VALUES ('$id_get2[0]', '0', '$plikNowy', '$plikCel')";
								mysqli_query($pol, $sql_zd);
							} else {
								// Plik za duży
							}
						} else {
							// Błąd wczytywania pliku
						}
					} else {
						// Zły format pliku
					}
				}
				
			}
		} else {
			echo '<script> alert("Pokój o takiej nazwie lub numerze już istnieje."); </script>';
		}
	}
	
	echo '<meta http-equiv="Refresh" content="0; URL=edytuj.php">';
	
	mysqli_close($pol);
?>