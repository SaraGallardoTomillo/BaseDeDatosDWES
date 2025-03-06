<!-- Insertar en la tabla productos de la base de datos pruebas un nuevo artículo con cada uno de sus campos (codigo, sección, nombre, fecha, pais y precio)
        actualizar y eliminar -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<?php
 include("./include/conexionPDO.php"); 
    // Inicializar mensajes
$mensaje = "";

// Insertar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'insertar') {
    $codigo = $_POST['codigo'];
    $seccion = $_POST['seccion'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $pais = $_POST['pais'];
    $precio = $_POST['precio'];

    $sql = "insert INTO productos (CODIGOARTICULO, SECCION, NOMBREARTICULO, FECHA, PAISDEORIGEN, PRECIO) VALUES (':codigo', ':seccion', ':nombre', ':fecha', ':pais', ':precio')";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':seccion', $seccion);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':precio', $precio);
    
    if ($stmt->execute()) {
        $mensaje = "Producto insertado correctamente.";
    } else {
        $mensaje = "Error al insertar el producto.";
    }
}

// Actualizar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'actualizar') {
    $codigo = $_POST['codigo'];
    $seccion = $_POST['seccion'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $pais = $_POST['pais'];
    $precio = $_POST['precio'];

    $sql = "update 'productos' SET SECCION = :seccion, NOMBREARTICULO = :nombre, FECHA = :fecha, PAISDEORIGEN = :pais, PRECIO = :precio WHERE CODIGOARTICULO = :codigo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':codigo', $codigo);
    $stmt->bindParam(':seccion', $seccion);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':precio', $precio);
    
    if ($stmt->execute()) {
        $mensaje = "Producto actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar el producto.";
    }
}

// Eliminar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $codigo = $_POST['codigo'];

    $sql = "DELETE FROM productos WHERE CODIGOARTICULO = :codigo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':codigo', $codigo);
    
    if ($stmt->execute()) {
        $mensaje = "Producto eliminado correctamente.";
    } else {
        $mensaje = "Error al eliminar el producto.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Productos</title>
</head>
<body>
    <h1>Gestionar Productos</h1>

    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <h2>Insertar Producto</h2>
    <form method="post" action="">
        <input type="hidden" name="accion" value="insertar">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required>
        <label for="seccion">Sección:</label>
        <input type="text" id="seccion" name="seccion" required>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <label for="pais">País de Origen:</label>
        <input type="text" id="pais" name="pais" required>
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" required>
        <input type="submit" value="Insertar Producto">
    </form>

    <h2>Actualizar Producto</h2>
    <form method="post" action="">
        <input type="hidden" name="accion" value="actualizar">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required>
        <label for="seccion">Sección:</label>
        <input type="text" id="seccion" name="seccion" required>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <label for="pais">País de Origen:</ input type="text" id="pais" name="pais" required>
        <label for="precio">Precio:</label>
        <input type="text" id="precio" name="precio" required>
        <input type="submit" value="Actualizar Producto">
    </form>

    <h2>Eliminar Producto</h2>
    <form method="post" action="">
        <input type="hidden" name="accion" value="eliminar">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required>
        <input type="submit" value="Eliminar Producto">
    </form>

    <?php
    // Cerrar la conexión
    $conexion = null;
    ?>
</body>
</html>