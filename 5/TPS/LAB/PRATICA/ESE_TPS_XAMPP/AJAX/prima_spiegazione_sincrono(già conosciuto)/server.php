<?php
    if(isset($_POST['nome']))
        $ris="Ciao" . $_POST['nome'];
    else
        $ris="errore nell'invio dei dati";
?>
<html>
    <head>
        <title>risposta server</title>
    </head>
    <body>
        <p>ciao <?php echo $ris ?></p>
    </body>
</html>";
