<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos pruebas</title>
    <?php
        include("./include/conexionPDO.php"); 

        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $codigoArticulo = $_POST['codigo_articulo'];

            // Consulta para obtener los detalles del producto con la protección de parámetros
            $sql = "SELECT * FROM productos WHERE CODIGOARTICULO = :codigoArticulo";
            $stmt = $conexion->prepare($sql);
            
            // Vinculamos el parámetro
            $stmt->bindParam(':codigoArticulo', $codigoArticulo, PDO::PARAM_STR);
            
            // Ejecutamos la consulta
            $stmt->execute();

            // Obtener el resultado
            $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>
</head>
<body>
<h1>Buscar Producto</h1>
    <form method="post" action="">
        <label for="codigo_articulo">Código del Producto:</label>
        <input type="text" id="codigo_articulo" name="codigo_articulo" required>
        <input type="submit" value="Buscar">
    </form>

    <?php if (isset($producto)): ?>
        <?php if ($producto): ?>
            <h2>Detalles del Producto</h2>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr>
                    <th>Código Artículo</th>
                    <th>Sección</th>
                    <th>Nombre Artículo</th>
                    <th>Fecha</th>
                    <th>País de Origen</th>
                    <th>Precio</th>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($producto['CODIGOARTICULO']); ?></td>
                    <td><?php echo htmlspecialchars($producto['SECCION']); ?></td>
                    <td><?php echo htmlspecialchars($producto['NOMBREARTICULO']); ?></td>
                    <td><?php echo htmlspecialchars($producto['FECHA']); ?></td>
                    <td><?php echo htmlspecialchars($producto['PAISDEORIGEN']); ?></td>
                    <td><?php echo htmlspecialchars($producto['PRECIO']); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>No se encontró ningún producto con el código ingresado.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    // Cerrar la conexión
    $conexion = null;
    ?>
</body>
</html>