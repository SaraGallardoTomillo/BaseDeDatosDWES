<?php
include_once("./include/BD.php");

// Verificar si se ha pasado el código del producto
if (isset($_GET['codigo'])) {
    $codigoProducto = $_GET['codigo'];
    $tiendas = Base::verTienda($codigoProducto); // Llamar al método de la clase Base
} else {
    $tiendas = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiendas para el Producto</title>
</head>
<body>
<div id="contenedor">
    <h1>Ver Tiendas</h1>
    <hr>
    <h1>Tiendas donde puedes comprar el articulo: <?php echo htmlspecialchars($codigoProducto); ?></h1>

    <?php
    if (!empty($tiendas)) {
        echo "<table>";
        echo "<caption>Tiendas disponibles</caption>";
        echo "<tr><th>Nombre</th><th>Unidades</th></tr>";

        $totalUnidades = 0; // Variable para contar el total de unidades

        foreach ($tiendas as $tienda) {
            echo "<tr>";
            echo "<td>{$tienda['nombre']}</td>"; // Acceder a los datos directamente
            echo "<td>{$tienda['unidades']}</td>"; // Mostrar unidades
            $totalUnidades += $tienda['unidades']; // Sumar unidades
            echo "</tr>";
        }

        echo "<tfoot><tr><td>TOTAL DE UNIDADES</td><td></td><td>{$totalUnidades}</td></tr></tfoot>";
        echo "</table>";
    } else {
        echo "<p>No se encontraron tiendas para el producto con código " . htmlspecialchars($codigoProducto) . ".</p>";
    }
    ?>
    <p><a href="index.php">Volver a la página principal</a></p>
</div>
</body>
</html>