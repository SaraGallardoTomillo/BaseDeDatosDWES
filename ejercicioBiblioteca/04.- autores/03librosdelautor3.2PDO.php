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
$sql = "select * from libro where NOMAUT='".$_REQUEST["selautor"]."' order by TITLIB ;";
$resultados=$conexion->query($sql);
if ($resultados->rowCount() > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<td><h3>ISBN</h3></td>";
		echo "<td><h3>TITULO</h3></td>";
		echo "<td><h3>EDITORIAL</h3></td>";
		echo "</tr>";
	   	echo "<h2>Libros de:   ".$_REQUEST['selautor']."</h2>";
		while ($fila=$resultados->fetch()){	
				echo "<tr><td>".$fila['ISBNLIB']."</td>";
				echo "<td>".$fila['TITLIB']."</td>";
				echo "<td>".$fila['EDILIB']."</td>";
				echo "</tr>";
			}
		echo "</table>";
	}
else 
	{ 
		echo "<h3>No se encontraron LIBROS publicados por :".$_REQUEST["selautor"]."</h3>"; 
	} 
}
catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;

?> 


