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
$codigo_pres=$_REQUEST["selprestamo"];
$sql="DELETE FROM `PRESTAMO` WHERE  ISBNPRE ='".$codigo_pres."'";
if ($conexion->exec($sql))  {
	echo "<div>Ha sido dado de baja el prestamo  $codigo_pres;</div> ";
	}
else
	{
	echo "<div>Imposible realizar el borrado</div>"; 	
	}
}
catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;?>

</body>
</html>




























