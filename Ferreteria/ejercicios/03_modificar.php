<?Php
require_once "./include/productos.php";
require_once "./include/BD.php";


  $array_de_productos = Base::getProductos();

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ferreteria Editar</title>

</head>

<body>
<div id="barrasuperior">
<h1><span class="subtitulo2">4.-FERRETERIA (Editar) (El clavo)</span></h1>
</div>
<div id="contenedor">

  <table width="100%" border="1" align="center">
    <tr >
      <td class="primera_fila">CodigoArticulo</td>
      <td class="primera_fila">Seccion</td>
      <td class="primera_fila">NombreArticulo</td>
      <td class="primera_fila">Fecha</td>
      <td class="primera_fila">PaisdeOrigen </td>
      <td class="primera_fila">Precio</td>
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
      <td class="bot"><a href="03_modificarForm.php?selcodigo=<?Php echo $producto->getCodigoArticulo(); ?>"><input type='button' name='del' id='del' value='Editar'></a></td>

     </tr>  
        <?Php
	endforeach;
	?>
  </table>
  

<p>&nbsp;</p>


</div>
</body>
</html>