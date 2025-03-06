<?php
  require_once "./clases/BD.php";
  require_once "./clases/viviendas.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inmobiliaria</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>

<body>
<div id="barrasuperior">
    <h1>Inmobiliaria  (Linda vista)</h1>
    <hr>
    <nav id="top_menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="?accion=consultar_todos">Consultar todos</a></li>
        <li><a href="indexPag.php">Consultar paginado</a></li>
        <li><a href="indexInsertar.php">Insertar vivienda</a></li>
        <li><a href="indexBorrar.php">Borrar vivienda</a></li>
    </ul>
    </nav>
    <hr>
  </div>

  <div id="contenedor">
  <?php
// Verificar si se ha solicitado consultar todos
if (isset($_GET['accion']) && $_GET['accion'] == 'consultar_todos') {
    $arrayViviendas = Base::getViviendas();
    ?>
  <table width="80%" border="1" align="center">
    <tr >
      <td>Tipo</td>
      <td>Zonas</td>
      <td>Dormitorios</td>
      <td>Precio</td>
      <td>Tamaño </td>
      <td>Extras</td>
      <td>Foto</td>
    </tr> 
    <?php
    foreach ($arrayViviendas as $vivi) { ?>
        <tr>
            
            <td><?php echo $vivi->getTipo(); ?></td>
            <td><?php echo $vivi->getZona(); ?></td>
            <td><?php echo $vivi->getNdormitorios(); ?></td>
            <td><?php echo $vivi->getPrecio(); ?></td>
            <td><?php echo $vivi->getTamano(); ?></td>
            <td><?php echo $vivi->getExtras(); ?></td>
            <td><img src="<?php echo $vivi->getFoto(); ?>" alt=""></td>
        </tr>
    <?php
    }
    ?>
 </table>
 <?php
} else {
    echo "<p>Bienvenido a la inmobiliaria Linda Vista. Seleccione una opción del menú.</p>";
}
?>
</div>
</body>
</html>