<?php

function connDB(){
    $host = 'localhost';
    $db = 'gelateria';
    $user = 'root';
    $psw = '';
    $strConn = "mysql:dbname=$db;host=$host";

    try{
        $conn = new PDO($strConn, $user, $psw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        $conn = null;
    }
    return $conn;
}

function eseguiQuery($query){
    $conn = connDB();
    if($conn != null){
        try{
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $ris = $stmt->fetchAll();
        }catch(PDOException $e){
            $ris = null;
        }
    }
    return $ris;

}



?>