<?php
/*
 * Lägger till ny kund
*/

// Skapar databaskopplingen
$connection = mysqli_connect("db", "root", "password", "customerDB") or die("Could not connect");
// Väljer databas
mysqli_select_db($connection,"customerDB") or die("Could not select database");

// Lägga till ny kund?
if(isset($_POST['isnew']) && $_POST['isnew'] == 1){
	$date = date("Y-m-d H:i:s");
	// mysqli_real_escape_string motverkar SQLInjection
	$name = mysqli_real_escape_string($connection,$_POST['txtName']);
	$email = mysqli_real_escape_string($connection,$_POST['txtEmail']);
	$password = mysqli_real_escape_string($connection,$_POST['txtPassword']);
	// Sparar lösenordet med password_hash
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

	$query = "INSERT INTO customer
			(customerName,customerEmail,customerPassword,customerDate)
			VALUES('$name','$email','$passwordHash','$date')";

	$result = mysqli_query($connection,$query) or die("Query failed: $query");

    $insId = mysqli_insert_id($connection);

    header("Location: index.php");
}
?>
<!DOCTYPE HTML>
<html lang="sv">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="stylefilm.css"> 
<title>Skapa ett konto</title>
</head>

<body>
<h1>Skapa ett konto</h1>

<form action="customer_create.php" method="post">
 <input type="hidden" name="isnew" id="isnew" value="1">
    <label>Namn:</label>
    <p><input type="text" name="txtName" placeholder="Ditt namn:"></p>
	
    <label>E-post:</label>
    <p><input type="email" name="txtEmail" placeholder="Din e-post:"></p>
     
    <label>Lösenord:</label>
    <p><input type="password" name="txtPassword" placeholder="Välj lösenord:"></p>

    <p><input type="submit" value="Lägg till"></p>
</form>
<?php
// Stänger databaskopplingen
mysqli_close($connection);
?>
</body>
</html>
