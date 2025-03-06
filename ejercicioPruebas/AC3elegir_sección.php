<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sección y mostrar el total </title>
    <?php
    include("./include/conexionPDO.php"); 
    // Inicializar variable para el total
    $totalPrecio = 0;
    $seccion = "";

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['seccion'])) {
        $seccion = $_POST['seccion'];

        // Consulta para obtener el total de precios de los productos en la sección seleccionada
        $sql = "select SUM(PRECIO) AS total FROM productos WHERE SECCION = :seccion";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':seccion', $seccion);
        $stmt->execute();

        // Obtener el resultado
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPrecio = isset($resultado['total']) && $resultado['total'] !== null ? floatval($resultado['total']) : 0;
    }

    // Consulta para obtener las secciones disponibles
    $sqlSecciones = "select distinct SECCION from productos";
    $stmtSecciones = $conexion->query($sqlSecciones);
    $secciones = $stmtSecciones->fetchAll(PDO::FETCH_COLUMN);
    ?>
</head>
<body>
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
                    echo '<option value="' . htmlspecialchars($seccionItem) . '">' . htmlspecialchars($seccionItem) . '</option>';
                }
            }
            ?>
        </select>
        <input type="submit" value="Calcular Total">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($seccion)): ?>
        <h2>Precio Total de los Productos en la Sección :"<?php echo htmlspecialchars($seccion); ?>"</h2>
        <p><?php echo $totalPrecio > 0 ? "El total es: $" . number_format($totalPrecio, 2) : "No hay productos en esta sección."; ?></p>
    <?php endif; ?>

    <?php
    // Cerrar la conexión
    $conexion = null;
    ?>
</body>
</html>
