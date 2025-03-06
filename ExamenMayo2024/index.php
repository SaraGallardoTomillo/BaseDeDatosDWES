<?php
include_once("./include/productos.php");
include_once("./include/BD.php");


// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productos'])) {
    $productosSeleccionados = $_POST['productos'];
    $mensaje = Base::comprarProductos($productosSeleccionados); // Llamar al método de la clase Base
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DES2</title>
</head>
<body>
<div id="contenedor">
    <div class="enlaces">
        <a href="verBorrados.php">Ver productos eliminados</a>
        <a href="borrar.php">Borrado definitivo</a>
    </div>

    <?php
    // Mostrar mensaje si existe
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
    }

    $array_de_productos = Base::getProductos();
    ?>
    
    <form action="" method="POST"> <!-- Formulario envuelve toda la tabla -->
        <table>
            <caption>Listado de articulos</caption>
            <tr>
                <th>Codigo</th><th>Nombre</th><th>Precio</th><th>Familia</th><th>Unidades</th><th>Tienda</th><th><button type="submit">Comprar</button></th>
            </tr>
            <?php
            foreach ($array_de_productos as $pro) {
                $totalUnidades=Base::getTotalUnidades($pro->getcod());
            ?>
                <tr>
                    <td><?php echo $pro->getcod(); ?></td>
                    <td><?php echo $pro->getnombre_corto(); ?></td>
                    <td><?php echo $pro->getPVP(); ?></td>
                    <td><?php echo $pro->getfamilia(); ?></td>
                    <td><?php echo  $totalUnidades;?></td>
                    <td><a href="verTienda.php?codigo=<?php echo $pro->getcod(); ?>">Ver Tienda</a></td>
                    <td>
                        <input type="checkbox" name="productos[]" value="<?php echo $pro->getcod(); ?>"> <!-- Cambiado a productos[] -->
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</div>
</body>
</html>