
<?php
//     0=nessun dato 1=elaborazione 2=dati non validi
    $caso=0;
    if(empty($_GET))
        form();
    else{
        $nome=$_GET['nome'];
        $eta=$_GET['eta'];
        $err="";
        $caso=0;
        if(isset($nome) && isset($eta)){
            /*
            if(controllaDati($nome,$eta,$err))
                $caso=1;
            else
                $caso=2;
            */
            if(controllaDati($nome,$eta,$err))
                echo "<p>i dati sono corretti gasa</p>";
            else
                echo "<p>$err</p>"
        }else{
            echo "dati non validi";
            //$caso=2;
        }
    }


function form(){
    ?>
    <DOCTYPE html>
    <html>
        <head>

        </head>
        <body>
             <?php // if($caso==0){ ?>
            <form id="form">
                <input type="text" name="nome" id="nome"><br>
                <input type="number" name="eta" id="eta"><br>
                <input type="submit" value="Invia">
            </form>
            <?php/* 
                }else if($caso==2)
                    echo "<p>$err</p>";
                else if($eta<18)
                    echo "<p>minorenne</p>";
                else
                    echo "<p>maggiorenne</p>";
            */?>
        </body>
    </html>
    <?php
}
?>