<?php
require_once './clases/BD.php'; // Asegúrate de incluir la clase Base
require_once './clases/viviendas.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger el ID de la vivienda a borrar
    $id = $_POST['bor'];

    // Validar que se ha seleccionado una vivienda
    if (empty($id)) {
        echo "<p style='color:red;'>Por favor, seleccione una vivienda para borrar.</p>";
    } else {
        // Intentar borrar la vivienda
        if (Base::borrarVivienda($id)) {
            echo "<p style='color:green;'>Vivienda borrada correctamente.</p>";
        } else {
            echo "<p style='color:red;'>Error al borrar la vivienda.</p>";
        }
    }
}

// Obtener todas las viviendas para mostrarlas en la tabla
$viviendas = Base::getViviendas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Borrar</title>
   <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>
<body>

<div id="barrasuperior">
    <h1>Inmobiliaria (Linda vista) - Borrar -</h1>
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

<form action="" method="post">
<div id="contenedor">
  <table width="80%" border="1" align="center">
    <tr>
      <td>Tipo</td>
      <td>Zonas</td>
      <td>Dormitorios</td>
      <td>Precio</td>
      <td>Tamaño</td>
      <td>Extras</td>
      <td>Foto</td>
      <td>Borrar</td>
    </tr>
    <?php foreach ($viviendas as $vivienda): ?>
    <tr>
      <td><?php echo $vivienda->getTipo(); ?></td>
      <td><?php echo $vivienda->getZona(); ?></td>
      <td><?php echo $vivienda->getNdormitorios(); ?></td>
      <td><?php echo $vivienda->getPrecio(); ?> Euros</td>
      <td><?php echo $vivienda->getTamano(); ?> m²</td>
      <td><?php echo $vivienda->getExtras(); ?></td>
      <td style="text-align: center;"><img src="<?php echo $vivienda->getFoto(); ?>" alt="Foto" width="50"></td>
      <td><input type="radio" name="bor" value="<?php echo $vivienda->getId(); ?>"></td>
    </tr>
    <?php endforeach; ?>
  </table>
  <p><input type="submit" value="Borrar vivienda"></p>
</form>
</div>

</body>
</html>