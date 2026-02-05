<?php
    $prodotti=file("prodotti.csv");
    if($_COOKIE["REQUEST_METHOD"]=="GET" && !empty($_GET)){
        if(isset($_COOKIE['carrello'])){
            $carrello=explode("|",$_COOKIE['carrello']);
        }
        if(isset($_GET['add']) && isset($_GET['prod'])){
            $carrello[]=$prod;
            setcookie("carrello",implode('|',$carrello),time()+3600);
        }

    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DADUZ</title>
        <script src="contr.js"></sctipt>
    </head>
    <body>
        <h1>54gi4hghe</h1>
        <form onsubmit="return check(this);">
            <select name="prodotti">
            <?php
                foreach($prodotti as $el){
                    $dati=explode(";",$el);
                    echo "<option value='$el'>".$dati[0] ."-". $dati[1] ."</option>"
                }
            ?>
            </select>
        </form>
    </body>
</html>