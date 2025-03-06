<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Editar.php</title>

</head>

<body>
<?Php
require_once "./include/BD.php";

if (!isset($_POST["actualizar"])){
	$producto=Base::encontrarProduto($_REQUEST["selcodigo"]);
	$codigo=$producto->getCodigoArticulo();
	$seccion=$producto->getSeccion();
	$nombre=$producto->getNombreArticulo();
	$fecha=$producto->getFecha();
	$pais=$producto->getPaisdeOrigen();
	$precio=$producto->getPrecio();
	
}else{
	
	$codigo=$_POST["f_codigo"];
	$seccion=$_POST["f_seccion"];
	$nombre=$_POST["f_nombre"];
	$fecha=$_POST["f_fecha"];
	$pais=$_POST["f_pais"];
	$precio=$_POST["f_precio"];
	Base::modificarProducto($codigo,$seccion,$nombre,$fecha,$pais,$precio);
	header("Location:03_modificar.php");
		
}
?>
<h1 style="text-align: center">Actualizar</h1>
<form action="<?Php  echo   $_SERVER['PHP_SELF'];  ?>" method="post"  name="form1" >
<table width="25%" border="1" align="center" bordercolor="#FFFFCC">
	<tr>
  <td width="85">Codigo</td>
    <td width="99"><input name="f_codigo" type="text" value="<?Php echo $codigo; ?>" readonly></td>
  </tr>
  <tr>
    <td width="85">Seccion</td>
    <td width="99"><input name="f_seccion" type="text" value="<?Php echo $seccion; ?>"></td>
  </tr>
  <tr>
    <td>Nombre</td>
    <td><input name="f_nombre" type="text" value="<?Php echo $nombre; ?>"></td>
  </tr>
  <tr>
    <td>Fecha</td>
    <td><input name="f_fecha" type="date" value="<?Php echo $fecha; ?>"></td>
  </tr>
   <tr>
    <td>Pais</td>
    <td><input name="f_pais" type="text" value="<?Php echo $pais; ?>"></td>
  </tr>
   <tr>
    <td>Precio</td>
    <td><input name="f_precio" type="text" value="<?Php echo $precio; ?>"></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="actualizar" id="submit" value="Actualizar"></td>
    </tr>
</table>



</form>



</body>
</html>