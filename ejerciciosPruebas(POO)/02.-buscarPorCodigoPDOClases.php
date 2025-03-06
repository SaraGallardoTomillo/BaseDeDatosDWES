<?php
include_once("./clases/Productos.php");
include_once("./clases/BD.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar productos</title>
    <link rel="stylesheet" href="./css/miflex.css"/>
</head>
<body>
	<div id="contenedor">
<?php
 $codigo="AR02";
 
	$producto = Base::getProducto($codigo);
	?>
	<table>
		<caption>Buscar articulos PDO clases con codigo: <?php echo $codigo; ?></caption>
		<tr>
		<th>Codigo</th><th>Seccion</th><th>Articulo</th><th>Fecha</th><th>Pais Origen</th><th>Precio</th>
		</tr>
			<tr>
    	<td><?php echo $producto->getCodigoArticulo() ; ?></td>
    	<td><?php echo $producto->getSeccion(); ?></td>
    	<td><?php echo $producto->getNombreArticulo(); ?></td>
    	<td><?php echo $producto->getFecha(); ?> </td>
    	<td><?php echo $producto->getPaisdeOrigen(); ?></td>
    	<td><?php echo $producto->getPrecio(); ?></td>
    	</tr>
		
	</table>
	<p><a href='indexPDO.php'>Volver a inicio</a></p>

</div>
</body>
</html>