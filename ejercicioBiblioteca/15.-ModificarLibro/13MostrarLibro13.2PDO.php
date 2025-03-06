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
if (isset ($_GET["Modificarlibro"])){
		$sql = "UPDATE LIBRO SET TITLIB='".$_GET["seltitulo"]."', EDILIB='".$_GET["seleditorial"]."', PRELIB='".$_GET["selprecio"]."' WHERE ISBNLIB='".$_GET["selisbn"]."'";
		
	if ($conexion->exec($sql)) {
			echo "<div>Ha sido modificado el libro con ISBN ".$_GET['selisbn']."</div> ";
	} else{
			echo "<div>Imposible realizar la modificación</div>"; 	
	}
$conexion = null;
exit();
	
}  //Cierro if
else {
       
	  	$sql = "select * FROM LIBRO WHERE ISBNLIB='".$_GET["selisbn"]."'";
		$resultados=$conexion->query($sql);
		$fila = $resultados->fetch();
		$titul=$fila["TITLIB"];
	 	$isbn=$fila["ISBNLIB"];
	 	$editorial=$fila["EDILIB"];
		$preci=$fila["PRELIB"];
		$aut=$fila["NOMAUT"];

}
?>



</head>
<body>

<?php

echo "<form name='form1' method='gets' action='".$_SERVER['PHP_SELF']."'>";
	echo "<table>";
	echo "<tr> <td colspan='2' align='center'> MOSTRAR LIBRO </td> </tr>";
	echo "<tr> <td>ISBN:</td> <td>";
	echo "<input name='selisbn' type='text' id='selISBN'  readonly value='".$isbn."'>";
	echo "</td></tr>";
	echo "<tr> <td>TITULO:</td> <td>	<input name='seltitulo' type='text' id='selISBN'   size='70' value='".$titul."'></td> </tr>";
   
    echo "<tr> <td>EDITORIAL:</td> <td><input name='seleditorial' type='text' id='EDITORIAL' value='".$editorial."'></td></tr>";
    echo "<tr> <td>PRECIO:</td> <td><input name='selprecio' type='text' id='PRECIO' value='".$preci."'></td> </tr>";
	echo "<tr> <td>AUTOR</td> <td><input name='selautor' type='text' id='selNOMAUT'  readonly value='".$aut."'> ";
	echo "</td>";
	echo "</tr>";
	echo "<tr> <td colspan='2' align='center'> <input type='submit' name='Modificarlibro' value='Modificar Libro'>";
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
			
			
			
			
			