<?php
 include_once("./clases/Productos.php");
 include_once("./clases/BD.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado productos</title>
    <link rel="stylesheet" href="estilo.css"/>
</head>
<body>
<?php

 	$cod="AR100";
	

	$mensaje = Base::borrar_producto($cod);
	echo "<p ><h2 align='center'>Borrando producto con codigo : $cod </h2></p>";
	echo "<br> $mensaje </br>";
	echo "<p><a href='indexPDO.php'>Volver a inicio</a></p>";
	 

?> 
</body>
</html>
