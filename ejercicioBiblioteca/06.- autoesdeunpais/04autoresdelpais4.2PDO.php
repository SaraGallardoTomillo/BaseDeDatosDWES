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
$sql="select * from autor where PAIS='".$_POST["selpais"]."' order by NOMAUT ;";
$resultados=$conexion->query($sql);
if ($resultados->rowCount()> 0) {
			echo "<table>";
			echo "<tr>";
			echo "<th colspan='2'>LISTADO DE AUTORES DE ".$_POST["selpais"]."</th>";
			echo "</tr>";
			$i=0;
			while($fila =$resultados->fetch())     
				{
					$i++;
					echo "<tr><td>".$fila['NOMAUT']."</td>";
					echo "<td>";
					//hacemos un formulario por  cada autor con campo oculto y boton enviar
					echo "<form name='form".$i."' method='post' action='03librosdelautor3.2PDO.php'>";
					echo "<input name='selautor' type='hidden' id='selautor' value='".$fila["NOMAUT"]."'>";
	         		echo "<input type='submit' name='Submit2' value='Ver libros'>";
					echo "</form>";	
					echo "</td>";
					echo "</tr>";
				}
			echo "</table>";
		}
else 
		{ 
			echo "<h2>No se encontraron datos con ese dato buscado</h2>"; 
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








