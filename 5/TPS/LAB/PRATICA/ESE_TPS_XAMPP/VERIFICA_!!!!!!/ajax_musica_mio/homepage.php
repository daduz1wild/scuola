<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header(redirect: login.php);
    }else{
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Document</title>
    </head>
    <body>
        <a href="visPlaylist.php"><button>Visualizza Playlist</button></a>
    </body>
    </html>
<?php
    }
?>