<?php
    function cercaUser($usr, $psw) {    
        $fp = fopen("user.csv", "r");
        if($fp)
        {
            $user = null;
            while(($datiUsr = fgetcsv($fp, 0, ";")) && $user == null)
            {
                if($datiUsr[0] == $usr && $datiUsr[1] == $psw)
                    $user = $datiUsr;
            }
            fclose($fp);
        }
        if($user != null){
             unset($user[1]);
            $user = array_values($user);
        }
       
        return $user;       
    }
?>