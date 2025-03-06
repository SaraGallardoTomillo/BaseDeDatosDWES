<?php
include ("../include/conexionPDO.php");
try {
 if (isset($_GET["seltitulo"])) {
	  	$sql = "SELECT * FROM LIBRO WHERE TITLIB='".$_GET["seltitulo"]."'";
		$resultados=$conexion->query($sql);
		$fila = $resultados->fetch();
		$titul=$fila["TITLIB"];
	 	$isbn=$fila["ISBNLIB"];
	 	$editorial=$fila["EDILIB"];
		$preci=$fila["PRELIB"];
		$aut=$fila["NOMAUT"];
}
else{
	$isbn="Vacio";
	$editorial="Vacio";
	$preci="Vacio";
	$aut="Vacio";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca PDO</title>
    <link href="../estilos/estilo.css" type="text/css" rel="stylesheet">


<script>
function cerrar(){  
window.close();
window.open("http://localhost/Basesdedatos/14.-BuscarLibro/12BuscarLibro12PDO.php","",""); 
}
</script>

</head>
<body>
<?php

echo "<form name='form1' method='gets' action='".$_SERVER['PHP_SELF']."'>";
	echo "<table>";
	echo "<tr> <td colspan='2' align='center'> BUSCAR UN LIBRO </td> </tr>";
	 echo "<tr> <td>TITULO:</td> <td>";
	if (!isset($_GET["seltitulo"])){
			$sql = "SELECT * FROM LIBRO";
			echo "<select name='seltitulo' id='selautor'>";
			$resultados=$conexion->query($sql);
			while($fila = $resultados->fetch()) {
					echo "<option value='";
					echo $fila["TITLIB"];
					echo "'>";
					echo $fila["TITLIB"];
					echo "</option>";
			}
			 echo "</select>";
	}
	else {
		echo "<input name='seltitulo' type='text' id='selISBN' size='90' readonly placeholder='".$titul."'>";
		
	}

	echo "</td></tr>";
	echo "<tr> <td>ISBN:</td> <td>	<input name='selisbn' type='text' id='selISBN'  readonly placeholder='".$isbn."'></td> </tr>";
   
    echo "<tr> <td>EDITORIAL:</td> <td><input name='seleditorial' type='text' id='EDITORIAL'  readonly placeholder='".$editorial."'></td></tr>";
    echo "<tr> <td>PRECIO:</td> <td><input name='selprecio' type='text' id='PRECIO' readonly placeholder='".$preci."'></td> </tr>";
	echo "<tr> <td>AUTOR</td> <td><input name='selautor' type='text' id='selNOMAUT'  readonly placeholder='".$aut."'> ";
	echo "</td>";
	echo "</tr>";
	if  (!isset($_GET["Buscar"])){
		echo "<tr> <td colspan='2' align='center'> <input type='submit' name='Buscar' value='BUSCAR'>";
		}
	else{
		echo "<tr> <td colspan='2' align='center'>  <input name='button' type='button' onclick='cerrar();' value='Salir' />  ";
	  	}
	echo "</td> </tr>";
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
			
			
			
			
			