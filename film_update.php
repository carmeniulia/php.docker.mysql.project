<?php
/*
 * Uppdatera kund
*/

session_start();
if($_SESSION['status'] != "ok"){
    header("Location: index.php");
}

require("includes/conn_mysql.php");

// Skapar databaskopplingen
$connection = dbConnect();

// Skall kunden redigeras?
if(isset($_GET['editid']) && $_GET['editid'] > 0 ){
	$query = "SELECT * FROM film WHERE filmId=". $_GET['editid'];

	$result = mysqli_query($connection,$query);

	$row = mysqli_fetch_assoc($result);
}

// Skall kunden uppdateras?
if(isset($_POST['updateid']) && $_POST['updateid'] > 0){
	// mysqli_real_escape_string motverkar SQLInjection
	$title = mysqli_real_escape_string($connection,$_POST['title']);
	$content = mysqli_real_escape_string($connection,$_POST['description']);
	$editid = $_POST['updateid'];

	$query = "UPDATE film
			SET filmTitle='$title', filmDescription='$content'
			WHERE filmId=". $editid;

	$result = mysqli_query($connection,$query) or die("Query failed: $query");

	// Skickar tillbaka till sidan med GET-editid
	header("Location: film_update.php?editid=".$editid);
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="stylefilm.css">  
<title>Kunder - Uppdatera film</title>
</head>

<body>
<h1>Uppdatera <?php echo $row['filmTitle']; ?></h1>
<p><a href="film.php">Tillbaka</a></p>

<form action="film_update.php" method="post">
   	<input type="hidden" name="updateid" value="<?php echo $row['filmId']; ?>">

    <label>Titel:</label>
    <p><input type="text" name="title" value="<?php echo $row['filmTitle']; ?>"></p>

    <label>Description:</label>
    <p>
    <textarea rows="4" cols="50" name="description" ><?php echo $row['filmDescription']; ?></textarea>
    </p>
    <p><input type="submit" value="Uppdatera"></p>
	
</form>
<?php
// Stänger databaskopplingen
mysqli_close($connection);
?>

</body>
</html>
