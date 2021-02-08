<?php
/*
  * Visar alla filmer
*/
session_start();

$loggedOn = false;
// Kontrollerar Adminbehörighet
if (isset($_SESSION['status'])) {
    $loggedOn = true;
}

require("includes/conn_mysql.php");

// Skapar databaskopplingen
$connection = dbConnect();

// Visar alla filmer i tabellen
$query = "SELECT filmId, filmTitle, filmDescription, namn
FROM film
INNER JOIN kategori
ON film.kategoriId = kategori.kategoriId
ORDER BY filmId desc;";

$result = mysqli_query($connection, $query);
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<link rel="stylesheet" href="stylefilm.css"> 
<meta charset="utf-8" />
</head>

<body>
    <h1 class="center">Film lista</h1>

    <p><a href="home.php">Hem</a></p>  

    <?php
    if ($loggedOn) {
    ?>
       
         <p class="align"> <a href="logout.php">Logga ut</a></p>
         <p><a href="film_create.php">Lägg till ny film</a> </p><br> 

    <?php
    }
    ?>
  
        <?php
        
        while ($row = mysqli_fetch_array($result)) {
        ?>
         <p class="block"> <b>  <?php echo $row['filmTitle']; ?> </b> <br> <?php echo $row['filmDescription']; ?> <br> Kategori: <?php echo $row['namn']; ?> <br> <br>
                <?php
                if ($loggedOn) {
                ?>
                    <a href="film_update.php?editid=<?php echo $row['filmId']; ?>">Uppdatera</a> <a href="film_delete.php?deleteid=<?php echo $row['filmId']; ?>">Ta bort</a>
                </p> 
    <?php
                }
            }
    ?>


     
    <?php
    // Stänger databaskopplingen
    mysqli_close($connection);
    ?>
    
   
</body>

</html>