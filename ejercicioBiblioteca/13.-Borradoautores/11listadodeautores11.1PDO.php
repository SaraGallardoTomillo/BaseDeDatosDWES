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
$sql = "SELECT * FROM AUTOR ORDER BY NOMAUT";
echo "<h2>LISTADO DE AUTORES</h2>";
echo "<form name='form1' method='post' action='11borrautor11.2PDO.php'>";
			echo  "<p>";
			echo  "<select name='selautor' id='selautor'>";	
			echo "<option value=''>Selecciona un autor</option>";
					$resultados=$conexion->query($sql);
					while($fila = $resultados->fetch()) {
							echo "<option value='";
							echo $fila['NOMAUT'];
							echo "'>";
							echo $fila['NOMAUT']."-----".$fila['PAIS'];
							echo "</option>";
					}
			echo "</select>";
            echo "</p>";
           	echo "<p>";
          	echo "<input type='submit' name='Submit' value='Borrar autor'>";
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
			
			
