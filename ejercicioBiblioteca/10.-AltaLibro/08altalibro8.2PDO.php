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
$ISBNLIB=$_REQUEST["selisbn"];
$TITLIB=$_REQUEST["seltitulo"];
$EDILIB=$_REQUEST["seleditorial"];
$PRELIB=$_REQUEST["selprecio"];
$NOMAUT=$_REQUEST["selautor"];
$sql="INSERT INTO `libro` ( `ISBNLIB` , `TITLIB` , `EDILIB` , `PRELIB` , `NOMAUT` )
VALUES ('$ISBNLIB', '$TITLIB', '$EDILIB', '$PRELIB', '$NOMAUT') ";
if ($conexion->exec($sql))  {
	echo "<div>Ha sido dado de alta el libro del autor;  $NOMAUT <br><br>";
	echo "Isbn: ".$ISBNLIB."<br>"."Titulo: ".$TITLIB."<br>"."Editorial: ".$EDILIB."<br>"."Precio: ".$PRELIB."</div>";
	}
else
	{
	echo "<div>Imposible realizar la inserción del libro: '$TITLIB'</div>"; 	
	}
}
catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;

?>






























