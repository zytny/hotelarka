<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
?>
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
			
			require_once "dane.php";
			$id = $_POST['identyfikator'];
			$email = $_POST['mail'];
			$temat = "Anulowanie rezerwacji";
			$tresc = "Dzień dobry, 
			<br> Rezerwacja została anulowana. 
			<br> Zapraszamy do kontaktu oraz ponownej rezerwacji. 
			<br> Z poważaniem, <br> Zespół Hotelarka";
			$od = $adres_email;
			
			

			require_once "PHPMailer/PHPMailer.php";
			require_once "PHPMailer/SMTP.php";
			require_once "PHPMailer/Exception.php";

			$mail = new PHPMailer();
				$mail->isSMTP();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->Username = $adres_email;
				$mail->Password = $haslo;
				$mail->Port = 465; //587
				$mail->SMTPSecure = "ssl";

				$mail->isHTML(true);
				$mail->setFrom($od, "Hotelarka");
				$mail->addAddress($email);
				$mail->CharSet= 'utf-8';
				$mail->Subject = $temat;
				$mail->Body = $tresc;
				
				if ($mail->send()) {
					$status = "success";
					$response = "Wiadomość e-mail została wysłana poprawnie!";
				} else {
					$status = "failed";
					$response = "Wystąpił błąd podczas wysyłania wiadomości. <br> Prosimy sprawdzić dane logowania.";
				}
				
				echo $response;	
				echo "<br><a href='recepcja.php'>Wróć do panelu recepcjonisty</a>";
				
				$kwerenda = "UPDATE rezerwacja SET przestarzale = '1' WHERE rezerwacja.ID = $id";

				mysqli_query($pol, $kwerenda);

			mysqli_close($pol);
		?>
		</div>
		<?php else : ?>
		
		<?php echo '<meta http-equiv="Refresh" content="0; URL=index.php">'; ?>
		
		<?php endif; ?>
	</body>
</html>