<?php
include_once("./clases/Productos.php");
include_once("./clases/BD.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado productos</title>
    <link rel="stylesheet" href="./css/miflex.css"/>
</head>
<body>
<div id="contenedor">
<?php

	$array_de_productos = Base::getProductos();
	?>
	<table>
		<caption>Listado de articulos PDO</caption>
		<tr>
		<th>Codigo</th><th>Seccion</th><th>Articulo</th><th>Fecha</th><th>Pais Origen</th><th>Precio</th>
		</tr>
	<?php
	foreach ($array_de_productos as $pro){ ?>
		<tr>
    	<td><?php echo $pro->getCodigoArticulo() ; ?></td>
    	<td><?php echo $pro->getSeccion(); ?></td>
    	<td><?php echo $pro->getNombreArticulo(); ?></td>
    	<td><?php echo $pro->getFecha(); ?> </td>
    	<td><?php echo $pro->getPaisdeOrigen(); ?></td>
    	<td><?php echo $pro->getPrecio(); ?></td>
    	</tr>
		<?php
	}
	?>
	</table>
	<p><a href='indexPDO.php'>Volver a inicio</a></p>
	
</div>
</body>
</html>
