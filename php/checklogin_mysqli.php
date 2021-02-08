<?php
// Startar upp sessionen
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
<link rel="stylesheet" href="stylefilm.css"> 
<title>Sessioner Hem</title>
<meta charset="utf-8" />
</head>
<body class="checkin" >
<?php
// Skapar databaskopplingen
$connection = mysqli_connect("db", "root", "password", "customerDB") or die("Could not connect");
// Väljer databas
mysqli_select_db($connection, "customerDB") or die("Could not select database");

// Hämtar användare och lösenord från formuläret
$checkUser = mysqli_real_escape_string($connection,$_POST['txtUser']);
$checkPass = mysqli_real_escape_string($connection,$_POST['txtPassword']);

// kontrollerar om användaren finns
$query = "SELECT * FROM customer
			WHERE customerEmail = '$checkUser'";

$result = mysqli_query($connection,$query) or die("Query failed: $query");

$row = mysqli_fetch_assoc($result);

// Mysqli_num_row räknar antalet rader, dvs om träff på användaren
$count = mysqli_num_rows($result);

if($count == 1) {
    // Kontrollerar lösenordet, använder password_hash för att kontrollera hash mot databasen
    if (password_verify($checkPass, $row["customerPassword"])) {
        $_SESSION['status'] = "ok";
        echo "<p>Du har loggat in, klicka på länken för att gå vidare!</p>";
        echo '<p><a href="home.php">Gå till hem</a></p>';
    } else {
        echo "<p>Du har inte fyllt i rätt användare och lösenord</p>";
        echo '<p><a href="index.php">Försök igen</a></p>';
    }
}
// Stänger databaskopplingen
mysqli_close($connection);
?>
</body>
</html>