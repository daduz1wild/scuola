<?php
if($_SERVER["METHOD_REQUEST"]=="POST" && isset($_FILE)){
    $nomeFile=$_FILE['file']['name'];
    $sizeFile=$_FILE['file']['size'];
    $typeFile=$_FILE['file']['type'];
    $percorsoFile=$_FILE['file']['type'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ricezione file</title>
</head>
<body>
    <?php  echo $nomeFile;
    echo "il nome del file è".$sizeFile;
    echo "il tipo di file è".$typeFile;
    ?>
</body>
</html>

<?php}?>