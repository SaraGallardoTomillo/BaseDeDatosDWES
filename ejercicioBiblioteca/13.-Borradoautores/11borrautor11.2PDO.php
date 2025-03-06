<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca PDO</title>
    <link href="../estilos/estilo.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php
include ("../include/conexionPDO.php");
try {
$nombre_autor=$_REQUEST["selautor"];
//Falta hacer el borrado bien, si es que el autor ha prestado libros
$sql="DELETE FROM `LIBRO` WHERE NOMAUT ='".$nombre_autor."'";
$numBorrados=$conexion->exec($sql);
echo "Registros borrados de libros".$numBorrados;
$sql="DELETE FROM `AUTOR` WHERE  NOMAUT ='".$nombre_autor."'";

if ($conexion->exec($sql)) {
	echo "<div><h2>Ha sido dado de baja el autor: $nombre_autor</h2></div> ";
	}
else
	{
	echo "<div><h2>Imposible realizar el borrado</h2></div>"; 	
	}
}
catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;
?>
</body>
</html>