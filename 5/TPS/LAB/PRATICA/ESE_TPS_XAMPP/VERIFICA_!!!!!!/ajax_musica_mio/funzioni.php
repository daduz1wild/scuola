<?php

function connDB(){
    $host="localhost";
    $db="db_canzoni";
    $user="root";
    $psw="";
    $strConn="mysql:dbname=$db;host=$host;"
    try{
        $conn= new PDO($strConn,$user,$psw);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }catch(PDOException è){
        $conn=0;
    }
    return $conn;
}

function eseguiQuery($query){
    $conn=connDB();
    if($conn!=0){
        try{
            $stmt=$conn->prepare($query);
            $stmt->execute();
            $ris=$stmt->fetchAll();
        }catch(PDOException e)
    }
}

?>