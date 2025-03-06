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
$sql = "SELECT * FROM LIBRO ORDER BY ISBNLIB";
echo "<h2>LISTADO DE LIBROS</h2>";
echo "<form name='form1' method='post' action='10borradodelibros10.2PDO.php'>";
			echo  "<p>";
			echo  "<select name='sellibro' >";	
					$resultados=$conexion->query($sql);
					while($fila = $resultados->fetch()) {
							echo "<option value='";
							echo $fila['ISBNLIB'];
							echo "'>";
							echo $fila['TITLIB']."----".$fila['EDILIB']."----".$fila['NOMAUT']."----".$fila['ISBNLIB'];
							echo "</option>";
					}
			echo "</select>";
            echo "</p>";
           	echo "<p>";
          	echo "<input type='submit' name='Submit' value='Borrar libro'>";
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