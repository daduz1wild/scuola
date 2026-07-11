<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
        require "db.php";
        $query= "SELECT * FROM impiegati";
        $result = executeSelect($query);
        if($result != null){
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }
    ?>
</body>
</html>