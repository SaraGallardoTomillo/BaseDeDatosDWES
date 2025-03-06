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
try{
	$sql = "select distinct PAIS from autor where pais<>'' order by PAIS ;";
	echo "<p><h2>LISTADO DE PAISES DE LOS AUTORES</h2></p>";
	echo "<form name='form1' method='post' action='02autoresdelpais2.2PDO.php'>";
	echo "<p>";
	echo "<select name='selpais' id='selpais'>";	
	echo "<option value=''>Selecciona un pais</option>";
	$resultados=$conexion->query($sql);
	while ($fila=$resultados->fetch(PDO::FETCH_ASSOC)){
					echo "<option value='";
					echo $fila["PAIS"];
					echo "'>";
					echo $fila["PAIS"];
					echo "</option>";
				}
	echo "</select>";
    echo "</p>";
    echo "<p align='center'>";
    echo "<input type='submit' name='Submit' value='Autores'>";
    echo "</p>";
    echo "</form>";
}
catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;
?>
</body>
</html>			
			
			
