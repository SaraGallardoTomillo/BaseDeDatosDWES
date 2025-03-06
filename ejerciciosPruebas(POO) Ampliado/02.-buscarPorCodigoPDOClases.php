<?php
include_once("./clases/Productos.php");
include_once("./clases/BD.php");

// Inicializamos la variable $codigo
$codigo = "";
if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
}

// Obtener el producto solo si hay un código ingresado
$producto = null;

if (!empty($codigo)) {
    $producto = Base::getProducto($codigo);
    // Verifica si no se encontró el producto
    if ($producto === 0) {
        $producto = null; // Resetear $producto en caso de no ser encontrado
    }
}
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
        <!-- Formulario para buscar productos -->
        <form method="POST" action="">
            <label for="codigo">Ingresa el código del producto:</label>
            <input type="text" name="codigo" id="codigo" required>
            <button type="submit">Buscar</button>
        </form>

        <?php if ($producto): ?>
    <table>
        <caption>Buscar artículos PDO clases con código: <?php echo ($codigo); ?></caption>
        <tr>
            <th>Código</th><th>Sección</th><th>Artículo</th><th>Fecha</th><th>País Origen</th><th>Precio</th>
        </tr>
        <tr>
            <td><?php echo ($producto->getCodigoArticulo()); ?></td>
            <td><?php echo ($producto->getSeccion()); ?></td>
            <td><?php echo ($producto->getNombreArticulo()); ?></td>
            <td><?php echo ($producto->getFecha()); ?></td>
            <td><?php echo ($producto->getPaisdeOrigen()); ?></td>
            <td><?php echo ($producto->getPrecio()); ?></td>
        </tr>
    </table>
    <?php else: ?>
        <p>No se encontró producto con el código: <?php echo ($codigo); ?></p>
    <?php endif; ?>
        <p><a href='indexPDO.php'>Volver a inicio</a></p>
    </div>
</body>
</html>