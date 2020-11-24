<?php

session_start();
?>
<!DOCTYPE html>
<html lang="pl-PL">

<head>
    <meta charset="utf-8">
    <meta name="keywords" content="rezerwacja, hotel, wakacje,booking">
    <title>Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

        <h1>System rezerwacji pokoju</h1>
        <hr />
        <!-- <h2>Formularz</h2>
    <form>
        <input type="text" placeholder="Imię" required><br />
        <input type="text" placeholder="Nazwisko" required><br />
        <input type="email" placeholder="E-mail" required><br />
        <input type="tel" placeholder="Numer telefonu" required><br />
        <select>
            <option value="pokój 1">Pokój 1-osobowy</option>
            <option value="pokój 2">Pokój 2-osobowy</option>
            <option value="pokój 3">Pokój 3-osobowy</option>
        </select>
        <button>Zapisz</button>
    </form>
-->
        
        
          <!--  <input type="text" name="login" />
            <br/>
            <input type="password" name="password" />
            <br/>
            <button type="submit">log in</button>
        </form>-->
      

        <div id="panel">
            <?php if (empty($_SESSION['user'])) : ?>
            <form action="login.php" method="post">
                <label for="username">Nazwa użytkownika:</label>
                <input type="text" id="username" name="username">
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password">
                <div id="lower">
                    <input type="checkbox"><label class="check" for="checkbox">Zapamiętaj mnie!</label>
                    <input type="submit" value="Login">
                </div>
            </form> 
             <?php else : ?>
        <p>
            <?=$_SESSION['user']?>
        </p>
        <a href="logout.php">logout</a>
        <?php endif; ?>
        </div>

</body>

</html>