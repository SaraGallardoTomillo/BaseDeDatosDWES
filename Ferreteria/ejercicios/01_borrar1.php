<?php
include_once("./include/productos.php");
include_once("./include/BD.php");

// Manejo de la eliminación de productos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    Base::eliminarProducto($codigo);
    // Redirigir para evitar reenvío del formulario
    header("Location: 01_borrar1.php");
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
<?php
    $array_de_productos = Base::getProductos();
?>
    <table>
        <caption>Listado de articulos</caption>
        <tr>
            <th>Codigo</th><th>Seccion</th><th>Articulo</th><th>Fecha</th><th>Pais Origen</th><th>Precio</th><th></th>
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
                <form action="" method="POST">
                    <input type="hidden" name="codigo" value="<?php echo $pro->getCodigoArticulo(); ?>">
                    <input type="submit" value="Borrar">
                </form>
            </td>
        </tr>
    <?php
    }
    ?>
    </table>
</div>
</body>
</html>