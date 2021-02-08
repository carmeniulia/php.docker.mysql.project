<?php
// Startar upp sessionen
session_start();

$loggedOn = false;
// Kontrollerar Adminbehörighet
if (isset($_SESSION['status'])) {
    $loggedOn = true;
}

?>
<!DOCTYPE html>
<html lang="sv">
<head>
<link rel="stylesheet" href="stylefilm.css">  
 <title>Sessioner Hem</title>
 <meta charset="utf-8" />
</head>
<body class="hemstyle">
 <h1> HEM </h1>

<?php
// Kontrollerar om sessions variabeln för inloggningen finns
if($_SESSION['status'] == "ok"){
	echo "<h6>Du är inloggad!</h6>";
} else{
	echo "<p>Du har inte behörighet för att se denna sida</p>";
}
?>




    <?php
    if ($loggedOn) {
    ?>
       <h4 class="align"> <a href="logout.php">Logga ut</a> </h4>
       <h4> <a href="customer_read.php">Mitt konto</a> </h4> 
       <h4> <a href="film_create.php">Lägg till ny film</a> </h4>
       <h4> <a href="film.php">Film lista</a> </h4>
       
    <?php
    }
    else { ?>
    
        <p> <a href="index.php">Logga in</a> <a href="film.php">Film lista</a>  </p>
    <?php
    }
    ?>
    




</body>
</html>