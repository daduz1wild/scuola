<?php
session_start();
if(isset($_SESSION['user'])){
    header("redirect: homepage.php");
}else{
    <form method="POST" onsubmit="return "
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN</title>
        <script src="script.js"></script>
    </head>
    <body>
        <form method="POST" onsubmit="srcUser(this); return false;" required>
            email:<input type="text" name="email">
            password:<input type="password" name="psw">
            <input type="submit" value="invia">
        </form>
        <div id="msgErr"></div>
    </body>
</html>
<?php
    }
?>