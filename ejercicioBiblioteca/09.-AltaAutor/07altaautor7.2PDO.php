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
$autor=$_POST["nombre"];
$pais=$_POST["pais"];
$sql = "INSERT INTO `autor` ( `NOMAUT` , `PAIS` ) VALUES ('$autor', '$pais');";
if ($conexion->exec($sql))  {
		echo "<div>Ha sido dado de alta el autor   ";
		echo $_POST["nombre"]." nacido en ".$_POST["pais"]."</div>"; 
}
else {
	echo "<div>Error. Imposible realizar el alta de $autor </div>";
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

