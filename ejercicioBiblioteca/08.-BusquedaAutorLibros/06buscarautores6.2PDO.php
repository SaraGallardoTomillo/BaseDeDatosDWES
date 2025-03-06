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
$sql="select * from autor where NOMAUT like '%".$_POST["palabra"]."%' order by NOMAUT ;";

$resultados=$conexion->query($sql);
if ($resultados->rowCount() > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<th>LISTADO DE AUTORES QUE CONTENGAN LA PALABRA ".$_POST["palabra"]."</th>";
		echo "<th>Enlace al autor</th>";
		echo "</tr>";
		$i=0;
		while($fila = $resultados->fetch()) {
			$i++;
			echo "<tr><td>".$fila['NOMAUT']."</td>";
			echo "<td>";
			$nombreautor=$fila["NOMAUT"];
			echo   "<a href='./03librosdelautor3.2PDO.php?selautor=$nombreautor'>$nombreautor</a> ";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
}
else 
		{ 
			echo "No se encontraron datos con ese dato buscado"; 
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










