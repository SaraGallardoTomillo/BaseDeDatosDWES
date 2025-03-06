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
$sql="select * from autor where PAIS='".$_POST["selpais"]."' order by NOMAUT ;";
$resultados=$conexion->query($sql);
if ($resultados->rowCount() > 0)  { 
				echo "<table>";
				echo "<tr>";
				echo "<th>LISTADO DE AUTORES DE :  ".$_POST["selpais"]."</th>";
				echo "</tr>";
				while ($fila=$resultados->fetch())
					{
						
					echo "<tr>";	
					echo "<tr><td>".$fila['NOMAUT']."</td>";
					echo "</tr>";
					}
				echo "</table>";
				}
	else 
				{ 
				echo "No se encontraron autores para el pais ".$_POST["selpais"]; 
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






