<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<meta name="keywords" content="rezerwacja, hotel, wakacje, booking">
		<title>Recepcja</title>
		<link rel="stylesheet" href="styl.css">
		<script>
			function validate(){
				var username= document.getElementById("username").value;
				var passw1= document.getElementById("passw1").value;
				var passw2= document.getElementById("passw2").value;
				var passchk = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
				
				if(username == null || username == "" || passw1 == null || passw1 == "" || passw2 == null || passw2 == "") {
				alert("Proszę upewnić się, że wprowadzone są wymagane dane.");
				return false;
				} else{
					if(username.length<5){
						alert("Podany login jest za krótki.");
						return false;
					} else {
						if(passw1.match(passchk)){
							if(passw1===passw2){
							alert("Konto zostało utworzone.");
							return true;
							} else {
							alert("Podane hasła nie są zgodne.");
							return false;
							}
						} else {
							alert("Podane hasło nie spełnia wymagań. Między 8 - 15 znaków, przynajmniej 1 duża i 1 mała litera, 1 cyfra i 1 znak specjalny.");
							return false;
						}
					}
				}	
			}
		</script>
	</head>
	<body onload="clock()">
			<?php
			$pol = mysqli_connect('localhost', 'root', '', 'projekt');
			
			$user = $_SESSION['user'];
			
			$zap = "SELECT ID FROM recepcjonista WHERE login = '$user'";
		
			$wyn = mysqli_query($pol, $zap);
		
			$arr = mysqli_fetch_array($wyn);
		?>
	
	<?php if ($arr[0] == '1') : ?>
	<div id="h_1">
		<h1>Zakładnie konta recepcjonisty</h1>
	</div>
        <hr /><br>
		<div id="panel">
			<form method="POST" action="create_user.php" onsubmit="return validate();">
				<label for="username">Login: </label>
				<input type="text" name="username" id="username"> <br>
				<label for="passw1">Hasło: </label>
				<input type="password" name="passw1" id="passw1"> <br>
				<label for="passw2">Powtórz hasło: </label>
				<input type="password" name="passw2" id="passw2"><br>
				<input type="hidden" name="c_type" value="0">
				<div id="lower">
				<input type="submit" value="Utwórz">
				</div>
			</form>
	
		<?php else : ?>
		
		<?php echo header('Location: zmien.php'); ?>
		
		<?php endif; ?>
		</div>
	</body>
</html>