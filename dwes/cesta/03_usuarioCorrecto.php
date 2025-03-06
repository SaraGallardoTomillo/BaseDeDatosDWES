<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    // Recuperamos la información de la sesión
    session_start();
?>
    <fieldset>
        <legend>Bienvenido <?php$_SESSION['usuario']?></legend>
        <p class= 'user'>Eres el usuario <?php $_SESSION['usuario']?></p><br>
        <a href='02_articulos.php'>Comenzar a comprar</a>
    </fieldset>
</body>
</html>