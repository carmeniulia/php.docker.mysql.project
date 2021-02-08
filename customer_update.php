<?php
/*
 * Uppdatera kund
*/

// Skapar databaskopplingen
$connection = mysqli_connect("db", "root", "password", "customerDB") or die("Could not connect");
// Väljer databas
mysqli_select_db($connection,"customerDB") or die("Could not select database");

// Skall kunden redigeras?
if(isset($_GET['editid']) && $_GET['editid'] > 0 ){
	$query = "SELECT * FROM customer WHERE customerId=". $_GET['editid'];

	$result = mysqli_query($connection,$query);

	$row = mysqli_fetch_assoc($result);
}

// Skall kunden uppdateras?
if(isset($_POST['updateid']) && $_POST['updateid'] > 0){
	// mysqli_real_escape_string motverkar SQLInjection
	$name = mysqli_real_escape_string($connection,$_POST['txtName']);
	$email = mysqli_real_escape_string($connection,$_POST['txtEmail']);
	$editid = $_POST['updateid'];

	$query = "UPDATE customer
			SET customerName='$name', customerEmail='$email'
			WHERE customerId=". $editid;

	$result = mysqli_query($connection,$query) or die("Query failed: $query");

	// Skickar tillbaka till sidan med GET-editid
	header("Location: customer_update.php?editid=".$editid);
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="stylefilm.css"> 
<title>Kunder - Uppdatera kund</title>
</head>

<body>
<h1>Uppdatera <?php echo $row['customerName']; ?></h1>
<p><a href="customer_read.php">Tillbaka</a></p>

<form action="customer_update.php" method="post">
   	<input type="hidden" name="updateid" value="<?php echo $row['customerId']; ?>">

    <label>Namn:</label>
    <p><input type="text" name="txtName" value="<?php echo $row['customerName']; ?>"></p>

    <label>E-post:</label>
    <p><input type="email" name="txtEmail" value="<?php echo $row['customerEmail']; ?>"></p>
     
    <p><input type="submit" value="Uppdatera"></p>
	
</form>
<?php
// Stänger databaskopplingen
mysqli_close($connection);
?>
</body>
</html>
