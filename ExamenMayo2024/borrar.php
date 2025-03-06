<?php
include_once("./include/BD.php"); // Asegúrate de incluir la clase Base

// Verificar si se ha enviado el formulario de confirmación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    // Llamar al método para borrar los productos
    $filasEliminadas = Base::borrarProductosBorrados(); // Usar el método de la clase Base

    // Mostrar mensaje de resultado
    if ($filasEliminadas > 0) {
        $mensaje = "Se han eliminado $filasEliminadas productos de la tabla.";

    } else {
        $mensaje = "No se encontraron productos para eliminar.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrado de Productos</title>
</head>
<body>
<div id="contenedor">
    <h1>¿Está seguro que quiere borrar los productos?</h1>
    
    <form action="" method="POST">
        <button type="submit" name="confirmar">Sí, borrar productos</button>
        <a href="index.php"><button type="button">No, cancelar</button></a>
    </form>

    <?php
    // Mostrar mensaje si existe
    if (isset($mensaje)) {
        echo "<p>$mensaje</p>";
        echo "<a href='index.php'>Volver al inicio</a>";
    }
    ?>
</div>
</body>
</html>