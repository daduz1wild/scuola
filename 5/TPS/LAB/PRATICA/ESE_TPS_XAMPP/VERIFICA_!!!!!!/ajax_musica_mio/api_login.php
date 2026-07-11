<?php
    require('funzioni.php');
    if(!isset($_POST['email'], $_POST['psw'])){
        header(login.php);
    }else{
        $email=$_POST['email'];
        $psw=$_POST['psw'];
        $query="SELECT * FROM utenti WHERE email='$email' AND psw='$psw';";
        $risUser=EseguiQuery($query);
        $risServer=null;
        if($risUser==0){
            $risServer="ERR_CONN";
        }else if(count($risUser)==0){
            $risServer="NO_USR";
        }else{
            $risServer="OK_USR";
        }
        session_start();
        $_SESSION['email']=$risUser[0]['email'];
    }
    echo $risServer;
?>