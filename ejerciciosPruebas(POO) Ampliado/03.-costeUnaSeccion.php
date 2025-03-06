<?php
    include_once("./clases/Productos.php");
    include_once("./clases/BD.php");
    $secciones=Base::getSeccionesDisponibles()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/miflex.css"/>
    <title>Coste Seccion</title>
</head>

<body>
<div id="contenedor">
<h1>Calcular Total Precio por Sección</h1>
    <form method="post" action="">
        <label for="seccion">Selecciona una Sección:</label>
        <select id="seccion" name="seccion" required>
            <option value="">-- Selecciona una sección --</option>
            <?php 
            if (empty($secciones)) {
                echo "<p>No hay secciones disponibles.</p>";
            } else {
                foreach ($secciones as $seccionItem) {
                    echo '<option value="' . ($seccionItem) . '">' . ($seccionItem) . '</option>';
                }
            }
            ?>
        </select>
        <input type="submit" value="Calcular Total">
    </form>
<?php
    $array_de_productos = Base::getSeccion($valor);
    ?>
    <table>
    <caption>Obtener Articulos de la seccion: <?php echo $valor ; ?></caption>
    <tr>
    <th>Codigo</th><th>Seccion</th><th>Articulo</th><th>Fecha</th><th>Pais Origen</th><th>Precio</th>
    </tr>
    <?php
    $totalCostes=0;
    foreach ($array_de_productos as $pro){ ?>
        <tr>
        <td><?php echo $pro->getCodigoArticulo() ; ?></td>
    	<td><?php echo $pro->getSeccion(); ?></td>
    	<td><?php echo $pro->getNombreArticulo(); ?></td>
    	<td><?php echo $pro->getFecha(); ?> </td>
    	<td><?php echo $pro->getPaisdeOrigen(); ?></td>
    	<td><?php echo $pro->getPrecio()." €";  
            $totalCostes+=$pro->getPrecio();
        ?></td>
       </tr>
       <?php } ?>
        <tr><td colspan="5">TOTAL SECCION : <?= $valor;?> </td><td><?php echo  $totalCostes." €";    ?></td></tr>
    
    </table>
    <p><a href='indexPDO.php'>Volver a inicio</a></p>
	
</div>
</body>
</html>