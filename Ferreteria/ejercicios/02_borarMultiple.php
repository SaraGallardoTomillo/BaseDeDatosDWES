<?php
include_once("./include/productos.php");
include_once("./include/BD.php");

// Manejo de la eliminación de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigos'])) {
    $codigos = $_POST['codigos']; // Array de códigos seleccionados
    foreach ($codigos as $codigo) {
        Base::eliminarProducto($codigo);
    }
    // Redirigir para evitar reenvío del formulario
    header("Location: 02_borarMultiple.php");
    exit();
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado productos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div id="contenedor">
    <form action="" method="POST">
        <?php
        $array_de_productos = Base::getProductos();
        ?>
        <table>
            <caption>Listado de articulos</caption>
            <tr>
                <th>Codigo</th>
                <th>Seccion</th>
                <th>Articulo</th>
                <th>Fecha</th>
                <th>Pais Origen</th>
                <th>Precio</th>
                <th><input type="submit" value="Borrar seleccionados"></th> <!-- Botón en la cabecera -->
            </tr>
            <?php
            foreach ($array_de_productos as $pro) { ?>
                <tr>
                    <td><?php echo $pro->getCodigoArticulo(); ?></td>
                    <td><?php echo $pro->getSeccion(); ?></td>
                    <td><?php echo $pro->getNombreArticulo(); ?></td>
                    <td><?php echo $pro->getFecha(); ?></td>
                    <td><?php echo $pro->getPaisdeOrigen(); ?></td>
                    <td><?php echo $pro->getPrecio(); ?></td>
                    <td>
                        <input type="checkbox" name="codigos[]" value="<?php echo $pro->getCodigoArticulo(); ?>">
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