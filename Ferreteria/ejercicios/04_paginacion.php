<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CRUD</title>
<link rel="stylesheet" type="text/css" href="estilo/miestilo.css"/>
</head>

<body>

<?Php
require_once "./include/productos.php";
require_once "./include/BD.php";

$array_de_productos = Base::getProductos();
	


if (isset($_POST["cr"])){
	$codigo=$_POST["f_codigo"];
	$seccion=$_POST["f_seccion"];
	$nombre=$_POST["f_nombre"];
	$fecha=$_POST["f_fecha"];
	$pais=$_POST["f_pais"];
	$precio=$_POST["f_precio"];
	$afectados=Base::insertar_producto($codigo,$seccion,$nombre,$fecha,$pais,$precio);
	if ($afectados>0){
			header("Location:04_paginacion.php");
	}else {
		echo "<script>alert('No se ha podido insertar el registro');</script>";
	}
}
$tamanio_pagina=5;
if (isset($_GET["pagina"])){
		if ($_GET["pagina"]==1){
			header ("Location:04_paginacion.php");
		}else{
			$pagina=$_GET["pagina"];
			
		}
}else{
		$pagina=1;	
	}
	
$numero_filas=count($array_de_productos);
$total_paginas=ceil($numero_filas/$tamanio_pagina);	

$inicio_desde=($pagina-1)*$tamanio_pagina;
$array_de_productos = Base::getProductosLimites($inicio_desde,$tamanio_pagina);

?>
<div id="barrasuperior">
<h1><span class="subtitulo2">FERRETERIA (El clavo)</span></h1>
</div>
<div id="contenedor">
<form action="<?Php  echo   $_SERVER['PHP_SELF'];  ?>" method="post">
  <table width="100%" border="1" align="center">
    <tr >
      <td class="primera_fila">CodigoArticulo</td>
      <td class="primera_fila">Seccion</td>
      <td class="primera_fila">NombreArticulo</td>
      <td class="primera_fila">Fecha</td>
      <td class="primera_fila">PaisdeOrigen </td>
      <td class="primera_fila">Precio</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
      <td class="sin">&nbsp;</td>
    </tr> 
   <?Php
   
   foreach ($array_de_productos as $producto):?>
		
   	<tr>
      <td> <?Php echo $producto->getCodigoArticulo(); ?></td>
      <td> <?Php echo $producto->getSeccion(); ?></td>
      <td> <?Php echo $producto->getNombreArticulo(); ?></td>
      <td> <?Php echo $producto->getFecha(); ?></td>
      <td> <?Php echo $producto->getPaisdeOrigen();?></td>
      <td> <?Php echo $producto->getPrecio(); ?></td>
      
    <td class='bot'><a href="04_editar.php?selcodigo=<?Php echo $producto->getCodigoArticulo(); ?> & selseccion=<?Php echo $producto->getSeccion();?> & selnombre=<?Php echo $producto->getNombreArticulo();?> & selfecha=<?Php echo $producto->getFecha();?> & selpais=<?Php echo $producto->getPaisdeOrigen();?>& selprecio=<?Php echo $producto->getPrecio();?>"> <input type='button' name='up' id='up' value='Editar'></a></td>

<td class="bot"><a href="04_borrar.php?selcodigo=<?Php echo $producto->getCodigoArticulo(); ?>"><input type='button' name='del' id='del' value='Borrar'></a></td>
    </tr>  
    
    <?Php
	endforeach;
	 
    ?>
   
         
	<tr>
	  <td><input type='text' name='f_codigo' size='10' class='centrado'></td>
      <td><input type='text' name='f_seccion' size='10' class='centrado'></td>
      <td><input type='text' name='f_nombre' size='10' class='centrado'></td>
      <td><input type='date' name='f_fecha' size='10' class='centrado'></td>
       <td><input type='text' name='f_pais' size='10' class='centrado'></td>
      <td><input type='text' name=' f_precio' size='10' class='centrado'></td>
      <td class='bot'><input type='submit' name='cr' id='cr' value='Insertar'></td></tr>    
  </table>
  <?Php
  for ($i=1;$i<=$total_paginas;$i++){
	echo "<a href='?pagina=" .$i. "'>".$i. "</a>  ";
  }?>
</form>
<p>&nbsp;</p>


</div>
</body>
</html>