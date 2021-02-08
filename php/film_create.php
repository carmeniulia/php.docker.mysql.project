<?php
/*
 * Lägger till ny kund
*/

require("includes/conn_mysql.php");

// Skapar databaskopplingen
$connection = dbConnect();


// Lägga till ny kund?
if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
	$date = date("Y-m-d H:i:s");
	// mysqli_real_escape_string motverkar SQLInjection
	$title = mysqli_real_escape_string($connection,$_POST['title']);
	$description = mysqli_real_escape_string($connection,$_POST['description']);
    $kategoriId = mysqli_real_escape_string($connection,$_POST['kategoriid']);;

	$query = "INSERT INTO film
			(filmTitle,filmDescription,filmDate,kategoriId)
			VALUES('$title','$description', NOW(), $kategoriId)";

	$result = mysqli_query($connection,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($connection);

    header("Location: film.php");
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="stylefilm.css"> 
<title>Kunder - Lägg till ny film</title>
</head>

<body>
<h1 class="center">Lägg till ny film</h1>
<p> <a href="home.php">Hem</a> <a href="film.php">Till film lista</a> </p> <br> <br>
<form action="film_create.php" method="post">
 <input type="hidden" name="isnew" id="isnew" value="1">
    <label>Titel:</label>
    <p><input type="text" name="title" placeholder="Titel:"></p>
	
    <label>Innehåll:</label>
    <!-- <p><input type="text" name="conent" ></p> -->
    <br>
    <textarea rows="4" cols="50" name="description" ></textarea>

    <?php 
    $query = "SELECT * FROM kategori";
    $result = mysqli_query($connection,$query);
    ?>
    <br>
    <p>Välj kategori:</p>
    <select  name="kategoriid">
    <?php 
        // Loopar genom arrayen som innehåller alla kunder i tabellen
        while($row = mysqli_fetch_array($result)){
    ?>
    <option value=<?php echo $row['kategoriId'];?>><?php echo $row['namn'];?> </option>
    <?php 
    };
    ?>
    
    </select>

     
    <p><input type="submit" value="Lägg till"></p>
</form>
<?php
// Stänger databaskopplingen
mysqli_close($connection);
?>


</body>
</html>
