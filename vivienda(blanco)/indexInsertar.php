<?php
require_once './clases/BD.php'; // Asegúrate de incluir la clase Base

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $tipo = $_POST['tipo'];
    $zona = $_POST['zona'];
    $direccion = $_POST['direccion'];
    $ndormitorios = $_POST['ndormitorios'];
    $precio = $_POST['precio'];
    $tamano = $_POST['tamano'];
    $extras = isset($_POST['extras']) ? implode(", ", $_POST['extras']) : '';
    $observaciones = $_POST['observaciones'];
    $foto = 'noDisponible.png'; // Imagen por defecto

    // Validar datos
    $errores = [];

    if (empty($direccion)) {
        $errores[] = "La dirección es obligatoria.";
    }

    if (!is_numeric($precio) || $precio <= 0) {
        $errores[] = "El precio debe ser un número positivo.";
    }

    if (!is_numeric($tamano) || $tamano <= 0) {
        $errores[] = "El tamaño debe ser un número positivo.";
    }

    // Si hay errores, mostrar mensajes
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Si no hay errores, insertar en la base de datos
        if (Base::insertarVivienda($tipo, $zona, $direccion, $ndormitorios, $precio, $tamano, $extras, $foto, $observaciones)) {
            echo "<p style='color:green;'>Vivienda insertada correctamente.</p>";
        } else {
            echo "<p style='color:red;'>Error al insertar la vivienda.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Insertar</title>
   <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>
<body>

<div id="barrasuperior">
    <h1>Inmobiliaria (Linda vista) - Insertar -</h1>
    <hr>
    <nav id="top_menu">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="index.php?accion=consultar_todos">Consultar todos</a></li>
            <li><a href="indexPag.php">Consultar paginado</a></li>
            <li><a href="indexInsertar.php">Insertar vivienda</a></li>
            <li><a href="indexBorrar.php">Borrar vivienda</a></li>
        </ul>
    </nav>
    <hr>
</div>

<div id="contenedor">
    <p><b>Introduzca los datos de la vivienda:</b></p>
    <form action="" method="post"> <!-- Cambiado a POST -->

        <p>Tipo de vivienda:
            <select name="tipo">
                <option value="Piso" selected>Piso</option>
                <option value="Adosado">Adosado</option>
                <option value="Chalet">Chalet</option>
                <option value="Casa">Casa</option>
            </select>
        </p>

        <p>Zona:
            <select name="zona">
                <option value="Centro">Centro</option>
                <option value="Nervión">Nervión</option>
                <option value="Triana">Triana</option>
                <option value="Aljarafe">Aljarafe</option>
                <option value="Macarena">Macarena</option>
            </select>
        </p>

        <p>Dirección:
            <input type="text" name="direccion" value=''>
        </p>

        <p>Número de dormitorios:
            <input type="radio" name="ndormitorios" value="1">1
            <input type="radio" name="ndormitorios" value="2">2
            <input type="radio" name="ndormitorios" value="3" CHECKED>3
            <input type="radio" name="ndormitorios" value="4">4
            <input type="radio" name="ndormitorios" value="5">5
        </p>

        <p>Precio: <input type="text" name="precio" value=''> Euros</p>

        <p>Tamaño: <input type="text" name="tamano" value=''> metros cuadrados</p>

        <p>Extras (marque los que procedan):
            <input type="checkbox" name="extras[]" value="Piscina">Piscina
            <input type="checkbox" name="extras[]" value="Jardín">Jardín
            <input type="checkbox" name="extras[]" value="Garage">Garage
        </p>

        <p>Observaciones:
            <textarea name="observaciones" COLS="50" ROWS="5"></textarea>
        </p>

        <p><input type="submit" value="Insertar vivienda"></p>

    </form>
</div>

</body>
</html>