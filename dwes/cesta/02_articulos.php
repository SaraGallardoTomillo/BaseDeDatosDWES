<?php
include_once("./include/BD.php");
include_once("./include/productos.php");

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");
}

// Inicializamos la cesta si no existe
if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = [];
}

// Manejo de la acción de añadir un producto
if (isset($_POST['aniadir'])) {
    $codigo_producto = $_POST['codigopro'];
    if (!in_array($codigo_producto, $_SESSION['cesta'])) {
        $_SESSION['cesta'][] = $codigo_producto; // Añadir el producto a la cesta
    }
}

// Manejo de la acción de vaciar la cesta
if (isset($_POST['vaciar'])) {
    $_SESSION['cesta'] = []; // Vaciar la cesta
}

// Comprobamos si la cesta está vacía
$cesta_vacia = empty($_SESSION['cesta']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="contenedor">

    <div id="encabezado">
        <h1>Listado de productos</h1>
    </div> <!--fin de encabezado-->

    <div id="cesta">
        <h3><img src="imagenes/cesta.png" alt="Cesta" width="24" height="21"> Cesta</h3>
        <hr />
        <?php if ($cesta_vacia): ?>
            <p>La cesta está vacía.</p>
        <?php else: ?>
            <p>Artículos en la cesta:</p>
            <ul>
                <?php foreach ($_SESSION['cesta'] as $codigo): ?>
                    <li><?php echo ($codigo); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <form id='vaciar' action='02_articulos.php' method='post'>
            <input class="cesta" type='submit' name='vaciar' value='Vaciar Cesta' <?php if ($cesta_vacia) print "disabled='true'" ; ?> />
        </form>
        <form id='comprar' action='04_factura.php' method='post'>
            <input class="cesta" type='submit' name='comprar' value='Comprar' <?php if ($cesta_vacia) print "disabled='true'" ; ?> />
        </form>
    </div>  <!--fin de cesta-->


    <div id="productos">
        <?php
            if (!isset($error)) {
                $array_de_productos = Base::getProductos();
                foreach ($array_de_productos as $pro) {
                    echo "<p><form id='form1' action='02_articulos.php' method='post'>"; // Cambiado a 'post'
                    // Metemos ocultos los datos de los productos
                    echo "<input type='hidden' name='codigopro' value='".$pro->getCodigo()."'/>";
                    echo "<input type='hidden' name='nombre' value='".$pro->getNombreCorto()."'/>";
                    echo "<input type='hidden' name='precio' value='".$pro->getPVP()."'/>";
                    echo "<input class='add' type='submit' name='aniadir' value='Añadir'/>";
                    echo htmlspecialchars($pro->getCodigo()) . " - " . htmlspecialchars($pro->getNombreCorto()) . " - " . htmlspecialchars($pro->getPVP());
                    echo "</form></p>";
                }
            }
        ?>
    </div>  <!--fin de productos-->

  <br class="divisor" />

  <!--<br class="divisor" />-->
  
    <div id="pie">
        <form action='02_logoff.php' method='post'>
            <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
        </form>        
        <?php
            if (isset($error)) {
                print "<p class='error'>Error $error: $mensaje</p>";
            }
        ?>
    </div> <!--fin de pie-->
</div> <!--fin de contenedor-->
</body>
</html>