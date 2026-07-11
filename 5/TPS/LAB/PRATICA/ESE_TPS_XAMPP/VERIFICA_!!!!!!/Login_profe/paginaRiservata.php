<?php
session_start();
if(!isset($_SESSION["user"]))
    header("Location: login.php");
else{
    $user = json_decode($_SESSION["user"]);

    $msgUser = (($user[3] == 'M') ? "Benvenuto" : "Benvenuta") . " " . $user[1] . " " . $user[2] . " - " . $user[4];
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <title>Pagina riservata</title>
</head>
<body>
    <h1>Pagina riservata</h1>
    <p><?=$msgUser?></p>  
    <a href="logout.php"><button>Logout</button></a>
</body>
</html>

<?php
}
?>


