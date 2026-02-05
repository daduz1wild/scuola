<?php
// ===============================
// CONTROLLO GD
// ===============================
if (!function_exists('imagecreatetruecolor')) {
    die("❌ Estensione GD non attiva.");
}


// ===============================
// CODIFICA MESSAGGIO
// ===============================
function encodeMessage($imagePath, $message) {
    $img = imagecreatefrombmp($imagePath);
    $message .= chr(0); // terminatore
    $binary = '';

    for ($i = 0; $i < strlen($message); $i++) {
        $binary .= str_pad(decbin(ord($message[$i])), 8, '0', STR_PAD_LEFT);
    }

    $width = imagesx($img);
    $height = imagesy($img);
    $index = 0;

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            if ($index >= strlen($binary)) break 2;

            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $r = ($r & 0xFE) | $binary[$index++];
            $color = imagecolorallocate($img, $r, $g, $b);
            imagesetpixel($img, $x, $y, $color);
        }
    }

    $out = "immagine_cifrata.bmp";
    imagebmp($img, $out);
    imagedestroy($img);
    return $out;
}

// ===============================
// DECODIFICA MESSAGGIO
// ===============================
function decodeMessage($imagePath) {
    $img = imagecreatefrombmp($imagePath);
    $width = imagesx($img);
    $height = imagesy($img);
    $binary = '';
    $message = '';

    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $binary .= ($r & 1);

            if (strlen($binary) === 8) {
                $char = chr(bindec($binary));
                if ($char === chr(0)) {
                    imagedestroy($img);
                    return $message;
                }
                $message .= $char;
                $binary = '';
            }
        }
    }
    imagedestroy($img);
    return $message;
}

// ===============================
// LOGICA FORM
// ===============================
$result = '';
$download = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $tmp = $_FILES['image']['tmp_name'];

    if ($_POST['action'] === 'encode' && !empty($_POST['message'])) {
        $download = encodeMessage($tmp, $_POST['message']);
    }

    if ($_POST['action'] === 'decode') {
        $result = decodeMessage($tmp);
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Steganografia Bitmap</title>
</head>
<body>

<h2>Steganografia su immagini BMP</h2>

<form method="post" enctype="multipart/form-data" id="stegoForm">
    <input type="file" name="image" accept=".bmp" required><br><br>

    <button type="submit" name="action" value="encode" onclick="showMessageInput()">Inserisci messaggio</button>
    <button type="submit" name="action" value="decode" onclick="hideMessageInput()">Decifra messaggio</button>

    <br><br>

    <div id="messageDiv" style="display:none;">
        <input type="text" name="message" placeholder="Messaggio segreto" id="messageInput">
    </div>
</form>

<script>
function showMessageInput() {
    document.getElementById('messageDiv').style.display = 'block';
    document.getElementById('messageInput').required = true;
}

function hideMessageInput() {
    document.getElementById('messageDiv').style.display = 'none';
    document.getElementById('messageInput').required = false;
}
</script>


<?php if ($download): ?>
    <p>✅ Immagine cifrata pronta:</p>
    <a href="<?= $download ?>" download>Scarica immagine</a>
<?php endif; ?>

<?php if ($result): ?>
    <p>🔓 Messaggio trovato:</p>
    <strong><?= htmlspecialchars($result) ?></strong>
<?php endif; ?>

</body>
</html>
