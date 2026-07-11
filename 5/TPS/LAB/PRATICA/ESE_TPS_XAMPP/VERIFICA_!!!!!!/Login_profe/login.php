<?php
session_start();
if(isset($_SESSION['username']))
    header("Location: paginaRiservata.php");
else{
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Login</title>
    <script src="script.js"></script>
</head>
<body>
    <h1>Login</h1>
    <form name="frmLogin" onsubmit="checkForm(this); return false;">
        <input type="text" name="usr" placeholder="username" required>
        <input type="password" name="psw" placeholder="password" required>
        <input type="submit" value="Login">
    </form>
    <div id="msgRis"></div>
    
</body>
</html>
<?php
}
?>