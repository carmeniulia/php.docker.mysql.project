<?php 
/*
  * Visar alla kunder
*/

// Skapar databaskopplingen
$connection = mysqli_connect("db", "root", "password", "customerDB") or die("Could not connect");
// Väljer databas
mysqli_select_db($connection,"customerDB") or die("Could not select database");

// Visar alla kunder i tabellen
$query = "SELECT * FROM customer ORDER BY customerName ASC";

$result = mysqli_query($connection,$query);
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="stylefilm.css"> 
<title>Mitt konto</title>
</head>

<body>
<h1 class="center">Mitt konto</h1>
<p class="center"><a href="home.php">Hem</a></p> 
<ul> <br> <br>
<?php 
	// Loopar genom arrayen som innehåller alla kunder i tabellen
 	while($row = mysqli_fetch_array($result)){
?>
 <li><?php echo $row['customerName'];?> <a href="customer_update.php?editid=<?php echo $row['customerId'];?>">Uppdatera</a> <a href="customer_delete.php?deleteid=<?php echo $row['customerId'];?>" >Ta bort</a></li> <br>
<?php 
	}
?>
</ul>
<?php
// Stänger databaskopplingen
mysqli_close($connection);
?>
</body>
</html>

