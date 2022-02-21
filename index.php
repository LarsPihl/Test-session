<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggadsida</title>
</head>
<body>

    <header style = "text-align: right">
        <p><?php 
Session_start();
$username = $_Session['username'];
    echo $username;
?></p>
        <form method = "post" action = "login.php">
        <input type="submit" class="button" name="utloggning" value="Logga ut" />
        </form>
    </header>
    
    <h2 style = "text-align: center">Du är inloggad.</h2>

    <?php

if(isset($_POST["utloggning"])) {

session_destroy();
}
    ?>
  

</body>
</html>