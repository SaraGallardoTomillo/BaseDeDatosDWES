<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca POO</title>
    <link href="../estilos/estilo.css" type="text/css" rel="stylesheet">
</head>

<body>
<?php
include ("../include/conexionPDO.php");
try {
$codigo_lib=$_REQUEST["sellibro"];
$sql="SELECT TITLIB FROM LIBRO WHERE ISBNLIB='".$codigo_lib."'";
$resultados=$conexion->query($sql);
$fila = $resultados->fetch();
$titulo=$fila[0];
$sql="DELETE FROM `PRESTAMO` WHERE  ISBNPRE ='".$codigo_lib."'";
$numBorrados=$conexion->exec($sql);
echo "prestamos borrados: ".$numBorrados;

$sql="DELETE FROM `LIBRO` WHERE  ISBNLIB ='".$codigo_lib."'";

//$conexion->query($sql);
if ($conexion->exec($sql)) {
	echo "<div><h2>Ha sido dado de baja el libro $titulo</h2></div> ";
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
