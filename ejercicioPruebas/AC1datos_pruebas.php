<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>

<body>

<?php
include("./include/conexionPDO.php"); 

    // Consulta para obtener los datos de la tabla productos
    $sql="Select * from productos;";
    $resultado = $conexion->query($sql);

    // Comenzar a construir la tabla HTML
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr>
            <th>Código Artículo</th>
            <th>Sección</th>
            <th>Nombre Artículo</th>
            <th>Fecha</th>
            <th>País de Origen</th>
            <th>Precio</th>
        </tr>";

    // Iterar sobre los resultados y crear filas en la tabla
    foreach ($resultado as $fila) {
        echo "<tr>
                <td>{$fila[0]}</td>
                <td>{$fila[1]}</td>
                <td>{$fila[2]}</td>
                <td>{$fila[3]}</td>
                <td>{$fila[4]}</td>
                <td>{$fila[5]}</td>
            </tr>";
    }

    // Cerrar la tabla
    echo "</table>";

    // Cerrar la conexión
    $conexion = null;
?> 
</body>
</html>
