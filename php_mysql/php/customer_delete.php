<?php
/*
 * Radera kund
 */

// Skapar databaskopplingen
$connection = mysqli_connect("db", "root", "password", "customerDB") or die("Could not connect");
// Väljer databas
mysqli_select_db($connection,"customerDB") or die("Could not select database");

// Kontrollera om kunden ska raderas
if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
    $isDeleteid = $_GET['deleteid'];
}

// Skall kunden raderas?
if(isset($_POST['isdeleteid']) && $_POST['isdeleteid'] > 0){
    $query = "DELETE FROM customer WHERE customerId=". $_POST['isdeleteid'];

    $result = mysqli_query($connection,$query) or die("Query failed: $query");

    // Skickar tillbaka till sidan som visar alla kunder
    header("Location: customer_create.php");
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylefilm.css"> 
    <title> Ta bort ditt konto</title>
</head>

<body>
<h1>Ta bort konto</h1>

<form action="customer_delete.php" method="post">
    <input type="hidden" name="isdeleteid" value="<?php echo $isDeleteid; ?>">

    <label>Vill du verkligen radera kontot?</label>
    <p><input type="submit" value="JA"></p>
</form>
</body>
</html>
