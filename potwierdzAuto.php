<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<?php
			$pol = mysqli_connect('localhost', 'root', '', 'projekt');

			use PHPMailer\PHPMailer\PHPMailer;

			$id = $_POST['identyfikator'];
			$email = $_POST['mail'];
			$temat = "Potwierdzenie rezerwacji";
			$tresc = "Dzień dobry,
			<br> Rezerwacja została potwierdzona.
			<br> Dziękujemy za wybór naszego hotelu. Życzymy udanego pobytu.
			<br> Z poważaniem,
			<br> Zespół Hotelarka";
			$od = "rezerwacja.hot@gmail.com";

			require_once "PHPMailer/PHPMailer.php";
			require_once "PHPMailer/SMTP.php";
			require_once "PHPMailer/Exception.php";

			$mail = new PHPMailer();
				$mail->isSMTP();
				$mail->Host = "smtp.gmail.com";
				$mail->SMTPAuth = true;
				$mail->Username = "rezerwacja.hot@gmail.com";
				$mail->Password = 'Hotelarka123';
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
					$response = "Email is sent!";
				} else {
					$status = "failed";
					$response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
				}

				json_encode(array("status" => $status, "response" => $response));
				
			$kwerenda = "UPDATE rezerwacja SET potwierdzenie = '1' WHERE rezerwacja.ID = $id";

			mysqli_query($pol, $kwerenda);
			
			header('Location: recepcja.php');

			mysqli_close($pol);
		?>
	</body>
</html>



