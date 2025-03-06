<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    // Recuperamos la información de la sesión
    session_start();
    echo "<fieldset>";
    echo "<legend>".$_SESSION['usuario']."</legend>";
    echo "Gracias por su compra<br/>";
    echo " Quiere <a href='index.php'>comenzar de nuevo</a>?";
    // Y la eliminamos la sesión
    session_unset();
    echo "</fieldset>";
?>
</body>
</html>