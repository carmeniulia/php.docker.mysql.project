<!DOCTYPE html>
<html lang="sv">
<head>
<link rel="stylesheet" href="stylefilm.css"> 
<title>Logga in</title>
<meta charset="utf-8" />
</head>
<body class="loggin">

<form action="checklogin_mysqli.php" method="post">
    <h1>Logga in</h1>

    <label>Användare (e-post):</label>
    <p><input type="email" name="txtUser"></p>

    <label>Lösenord:</label>
    <p><input type="password" name="txtPassword"></p>

    <p><input type="submit" name="submit" value="Logga in"></p>

    <p></p>
    
</form>

<p>Ny användare?</p>
<?php
echo '<p><a href="customer_create.php">Skapa konto</a></p>';
?>

</body>
</html>