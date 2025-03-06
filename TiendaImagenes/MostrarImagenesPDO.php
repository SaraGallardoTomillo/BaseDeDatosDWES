<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mostrar imagenes</title>
<link rel="stylesheet" type="text/css" href="css/miestilo.css"/>
</head>

<body>
<div>
<?php
require_once ("./Clases/BD.php");
try
{
if ((!isset($_REQUEST["siguiente"])) and (!isset($_REQUEST["anterior"]))) { //es la primera vez que vemos una foto
	$posicion=1;
	$ultimo=Base::numeroRegistros();
}
if ((isset($_REQUEST["siguiente"])) and (!isset($_REQUEST["anterior"]))) { //damos al siguiente
	$ultimo=$_REQUEST["ultimo"];
	$posicion=$_REQUEST["posicion"];
	if ($_REQUEST["posicion"]==$_REQUEST["ultimo"]){
		$posicion=1;
	}
}

if ((!isset($_REQUEST["siguiente"])) and (isset($_REQUEST["anterior"]))){ //damos al anterior
	$ultimo=$_REQUEST["ultimo"];
	$posicion=$_REQUEST["posicion"];
	if ($posicion<1){
		$posicion=$ultimo-1;
	}
}

$accesorio=Base::get1AccesorioPos($posicion);
?>

<table>
<tr><th colspan='2'>TIENDA DE IMAGENES </th>
</tr>

<tr>
	<td colspan='2'><a href="MostrarRegistroPDO.php?posicion=<?php echo $posicion;?>      "><img src="<?php echo $accesorio->getFoto();?>"></a></td>
</tr>
<tr>
	<td> <form action="MostrarImagenesPDO.php" method="get">
    		<input type='hidden' name='posicion' value="<?php echo $posicion-1;?>">
    		<input type='hidden' name='ultimo' value="<?php echo $ultimo;?>">
            <input type='submit' name='anterior' value='anterior' />
   		 </form>
    
    </td>
	<td><form action="MostrarImagenesPDO.php" method="get">
    		<input type='hidden' name='posicion' value="<?php echo $posicion+1;?>">
    		<input type='hidden' name='ultimo' value="<?php echo $ultimo;?>">
     		<input type='submit' name='siguiente' value='siguiente' />
   		 </form>
  	<tr>
	 </table>
	 </form>
<?php     

}catch (Exception $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
$conexion = null;
?> 
</div>
</body>
</html>