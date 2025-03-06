<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mostrar informacion </title>
<link rel="stylesheet" type="text/css" href="css/miestilo.css"/>
</head>

<body>
<div>
<?php 
require_once ("./clases/BD.php");
try
{
$valor=$_REQUEST['posicion']; 

$sql="select * from accesorios  WHERE codigoAcc=$valor";

//$valor++;

$accesorio=Base::get1AccesorioCodigo($valor);


	echo "<table>";
	echo "<tr><th colspan='4'>MOSTRAR ACCESORIO</th>";
	echo "</tr>";
	echo "<tr><th>Precio</th><th>Nombre</th><th>Descripción</th><th>Imagen</th>";
	echo "</tr>";
	echo "<tr>";
	echo "<td><input type='text' name='precio' value='".$accesorio->getPrecioAcc()."' readonly size='3'></td>";
	echo "<td><input type='text' name='nombre' value='".$accesorio->getNombreAcc()."' readonly size='30'></td>";
	
	echo "<td><textarea  name='descrip' readonly  cols='50'rows='7'> ". $accesorio->getDescripcionAcc()."  </textarea></td>";
	echo "<td><img src='".$accesorio->getFoto()."' width='400' heigh='200'> </td>";
	
	echo "</tr>";
	echo "</table>";


echo "<a href='MostrarImagenesPDO.php'>Volver a la página anterior</a>";
} catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;
		

 ?>
 </div>
</body>
</html>