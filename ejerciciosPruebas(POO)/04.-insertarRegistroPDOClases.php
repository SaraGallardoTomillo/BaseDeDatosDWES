<?php
 include_once("./clases/Productos.php");
 include_once("./clases/BD.php");
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar producto</title>
    <link rel="stylesheet" href="./css/miflex.css"/>
</head>
<body>
<div id="contenedor"> 
<?php

 	$cod="AR100";
	$sec="TALLER";
	$nom="DEPORTIVO";
	$fec= date("y-m-d");
	$pai="ESPAÑA";
	$pre=100;

	$mensaje = Base::insertar_producto($cod,$sec,$nom,$fec,$pai,$pre);
	?>
	<table>
		<caption>Insertar articulo con codigo: <?php echo $cod ; ?></caption>
		<tr>
			<th>Codigo</th><th>Seccion</th><th>Artticulo</th><th>Fecha</th><th>Pais Origen</th><th>Precio</th>
		</tr>
		<tr>
    		<td><?php echo $cod ; ?></td>
    		<td><?php echo $sec ?></td>
    		<td><?php echo $nom ?></td>
    		<td><?php echo $fec; ?> </td>
    		<td><?php echo $pai; ?></td>
    		<td><?php echo $pre; ?></td>
    	</tr>
		<tr>
			<td colspan='6' > <?php echo $mensaje; ?>   </td>
		</tr>
		</table>
    

<a href='indexPDO.php'>Volver a inicio</a>

</body>
</html>
