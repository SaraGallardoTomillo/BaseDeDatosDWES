<?php
include_once("./include/BD.php"); // Asegúrate de incluir la clase Base

// Obtener los productos borrados
$borrados = Base::getBorrados(); // Llamar al método para obtener los borrados
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Borrados</title>
</head>
<body>
<div id="contenedor">
    <h1>Productos Borrados</h1>

    <?php if (!empty($borrados)): ?>
        <table>
            <caption>Listado de productos borrados</caption>
            <tr>
                <th>Código</th>
                <th>Tienda</th>
                <th>Unidades</th>
            </tr>
            <?php foreach ($borrados as $borrado): ?>
                <tr>
                    <td><?php echo htmlspecialchars($borrado['producto']); ?></td>
                    <td><?php echo htmlspecialchars($borrado['tienda']); ?></td>
                    <td><?php echo htmlspecialchars($borrado['unidades']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay productos borrados para mostrar.</p>
    <?php endif; ?>
    <p><a href="index.php">Volver a la página principal</a></p>
</div>
</body>
</html>