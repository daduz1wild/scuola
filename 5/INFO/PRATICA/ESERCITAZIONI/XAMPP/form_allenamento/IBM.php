<html>
<head>
    <title>IBM CON zebi</title>
    <link rel="stylesheet" href="IBM.css">
</head>
<body>
    <?php
        if ( isset($_GET["nome"]) && isset($_GET["sesso"]) && isset($_GET["alt"]) && isset($_GET["peso"]) && isset($_GET["email"]) && isset($_GET["psw"]) && isset($_GET["confPsw"])){
            $nome=$_GET["nome"];
            $sesso=$_GET["sesso"];
            $alt=$_GET["alt"];
            $peso=$_GET["peso"];
            $email=$_GET["email"];
            $psw=$_GET["psw"];
            $confPsw=$_GET["confPsw"];
            if ($nome === "" || $sesso === "" || $alt < 20 || $peso < 10 ||!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($psw) < 8 || $psw !== $confPsw) 
                echo "<p>Dati non validi</p> ";
            else{
                $alt/=100;
                $ibm = $_GET['peso'] / ($alt * $alt);

                if ($ibm < 18.5) {
                   
                } else if ($ibm < 24.9) {
                    echo "normopeso<br>";
                    echo "<img src='normopeso.webp' alt='normopeso'>";
                } else if ($ibm < 29.9) {
                    echo "sovrappeso<br>";
                    echo "<img src='sovrappeso.webp' alt='sovrappeso'>";
                } else {
                    echo "obeso<br>";
                    echo "<img src='obeso.webp' alt='obeso'>";
                }
            }

        }
    ?>
</body>
</html>