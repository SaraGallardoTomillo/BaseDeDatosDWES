<?php
include_once("./include/BD.php");
include_once("./include/productos.php");

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

// Inicializamos la cesta si no existe
if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = [];
}

// Recuperamos los productos de la cesta
$cesta = $_SESSION['cesta'];
$total = 0;
$productos = [];

// Si hay productos en la cesta, calculamos el total
if (!empty($cesta)) {
    foreach ($cesta as $codigo) {
        $producto = Base::getProductoPorCodigo($codigo); // Asumiendo que tienes un método para obtener el producto por su código
        if ($producto) {
            $productos[] = $producto;
            $total += $producto->getPVP(); // Sumar el precio del producto al total
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div id="contenedor">

    <div id="encabezado">
        <h1>Factura de Compra</h1>
    </div> <!--fin de encabezado-->

    <div id="productos">
        <h3>Artículos en la Cesta</h3>
        <hr />
        <?php if (empty($productos)): ?>
            <p>No hay productos en la cesta.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li>
                        <?php echo ($producto->getNombreCorto()); ?> - 
                        Precio: <?php echo ($producto->getPVP()); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h3>Total a Pagar: <?php echo ($total); ?>€</h3>
        <?php endif; ?>
        <form action='01_pagar.php' method='post'>
            <input type='submit' name='pagar' value='Realizar Pago'/>
        </form>
    </div>  <!--fin de productos-->

    <div id="pie">
        <form action='02_articulos.php' method='post'>
            <input type='submit' name='volver' value='Volver a la tienda'/>
        </form>
        <form action='02_logoff.php' method='post'>
            <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
        </form>
    </div> <!--fin de pie-->
</div> <!--fin de contenedor-->
</body>
</html>