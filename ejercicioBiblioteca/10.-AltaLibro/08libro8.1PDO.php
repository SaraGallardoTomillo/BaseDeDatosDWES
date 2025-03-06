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
echo "<form name='form1' method='gets' action='08altalibro8.2PDO.php'>";
	echo "<table>";
	echo "<tr> <td colspan='2' align='center'> ALTA DE UN LIBRO </td> </tr>";
	echo "<tr> <td>ISBN:</td> <td> <input name='selisbn' type='text' id='selISBN' maxlength='20'></td> </tr>";
    echo "<tr> <td>TITULO:</td> <td> <input name='seltitulo' type='text' id='TITULO' size='100' maxlength='255'></td></tr>";
    echo "<tr> <td>EDITORIAL:</td> <td><input name='seleditorial' type='text' id='EDITORIAL' maxlength='50'></td></tr>";
    echo "<tr> <td>PRECIO:</td> <td><input name='selprecio' type='text' id='PRECIO'></div></td> </tr>";
	echo "<tr> <td>AUTOR</td> <td>";
	echo "<select name='selautor' id='selautor'>";
			$sql = "SELECT * FROM AUTOR";
			$resultados=$conexion->query($sql);
			while($fila =  $resultados->fetch()) {
					echo "<option value='";
					echo $fila["NOMAUT"];
					echo "'>";
					echo $fila["NOMAUT"];
					echo "</option>";
			}
	echo "</select>";
	echo "</td>";
	echo "</tr>";
	echo "<tr> <td colspan='2' align='center'> <input type='submit' name='Submit' value='Alta de libro'> </td> </tr>";
	echo "</table>";
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
			
			
			
			
			