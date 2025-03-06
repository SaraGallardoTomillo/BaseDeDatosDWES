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
        <li><a href="index.php?accion=consultar_todos">Consultar todos</a></li>
        <li><a href="indexPag.php">Consultar paginado</a></li>
        <li><a href="indexInsertar.php">Insertar vivienda</a></li>
        <li><a href="indexBorrar.php">Borrar vivienda</a></li>
    </ul>
    </nav>
    <hr>
</div>

<div id="contenedor">
<?php
// Contar el total de registros
$totalRegistros = Base::contarViviendas(); // Asegúrate de que este método esté implementado en tu clase Base
$registrosPorPagina = 3;
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Obtener la página actual
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$paginaActual = max(1, min($paginaActual, $totalPaginas)); // Asegurarse de que la página actual esté dentro de los límites

// Calcular el inicio para la consulta
$inicio = ($paginaActual - 1) * $registrosPorPagina;
$arrayViviendas = Base::getViviendasPag($inicio, $registrosPorPagina);
?>

<p>Mostrando viviendas (Página <?php echo $paginaActual; ?> de <?php echo $totalPaginas; ?>)</p>
<table width="80%" border="1" align="center">
    <tr>
        <td>Tipo</td>
        <td>Zonas</td>
        <td>Dormitorios</td>
        <td>Precio</td>
        <td>Tamaño</td>
        <td>Extras</td>
        <td>Foto</td>
    </tr> 
    <?php
    foreach ($arrayViviendas as $vivi) { ?>
        <tr>
            <td><?php echo htmlspecialchars($vivi->getTipo()); ?></td>
            <td><?php echo htmlspecialchars($vivi->getZona()); ?></td>
            <td><?php echo htmlspecialchars($vivi->getNdormitorios()); ?></td>
            <td><?php echo htmlspecialchars($vivi->getPrecio()); ?></td>
            <td><?php echo htmlspecialchars($vivi->getTamano()); ?></td>
            <td><?php echo htmlspecialchars($vivi->getExtras()); ?></td>
            <td><img src="<?php echo htmlspecialchars($vivi->getFoto()); ?>" alt="Foto de la vivienda" /></td>
        </tr>
    <?php
    }
    ?>
</table>

<div class="pagination">
    <?php if ($paginaActual > 1): ?>
        <a href="indexPag.php?pagina=<?php echo $paginaActual - 1; ?>">Anterior</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <a href="indexPag.php?pagina=<?php echo $i; ?>" <?php if ($i == $paginaActual) echo 'style="font-weight:bold;"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($paginaActual < $totalPaginas): ?>
        <a href="indexPag.php?pagina=<?php echo $paginaActual + 1; ?>">Siguiente</a>
    <?php endif; ?>
</div>

</div>
</body>
</html>