<?php
/*
 * Radera kund
 */

require("includes/conn_mysql.php");

// Skapar databaskopplingen
$connection = dbConnect();


if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
    $isDeleteid = $_GET['deleteid'];
}

// Skall kunden raderas?
if(isset($_POST['isdeleteid']) && $_POST['isdeleteid'] > 0){
    $query = "DELETE FROM film WHERE filmId=". $_POST['isdeleteid'];

    $result = mysqli_query($connection,$query) or die("Query failed: $query");

    // Skickar tillbaka till sidan som visar alla kunder
    header("Location: film.php");
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylefilm.css">  
    <title>Inlägg - Ta bort film</title>
</head>

<body>
<h1>Ta bort film</h1>

<form action="film_delete.php" method="post">
    <input type="hidden" name="isdeleteid" value="<?php echo $isDeleteid; ?>">

    <label>Vill du verkligen radera inlägget?</label>
    <p><input type="submit" value="JA"></p>
</form>

<p><a href="film.php">Till filmen</a></p>
</body>
</html>
