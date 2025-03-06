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
include("../include/conexionPDO.php"); 

try{
	$sql="Select * from autor;";
	echo "<h2> Listado de autores y su pais</h2>";
	echo '<table>';
	echo "<tr>";
	echo "<td><h2>Autores</h2></td>";
	echo "<td><h2>Pais</h2></td>";
	echo "</tr>";
	$resultados=$conexion->query($sql);
	while ($fila=$resultados->fetch()){
		echo "<tr>";
		echo "<td>".$fila[0]."</td>";
		echo "<td>".$fila[1]."</td>";
		echo "</tr>";
		}
	echo "</table>";
}
catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;
?> 
</body>
</html>
