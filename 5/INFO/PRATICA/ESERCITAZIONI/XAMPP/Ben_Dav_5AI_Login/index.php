<?php
# Benedetti Davide     5AI     19/12/2025     index.php
session_start();

if (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "client") {
    header("Location: client.php");
} elseif (isset($_SESSION['tipoUtente']) && $_SESSION['tipoUtente'] == "admin") {
    header("Location: admin.php");
} else {
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

<h2>LOGIN</h2>

<?php
if (isset($_GET['err'])) {
    echo "<p style='color:red'>" . $_GET['err'] . "</p>";
}
?>

<form action="checkUser.php" method="POST">
    Username: <input type="text" name="user" required><br><br>
    Password: <input type="password" name="psw" required><br><br>
    <input type="submit" value="Login">
</form>

</body>
</html>
<?php
}
?>
