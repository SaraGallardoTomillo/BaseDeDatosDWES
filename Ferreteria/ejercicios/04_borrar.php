<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?Php
require_once "./clases/BD.php";

$codigo=$_GET["selcodigo"];
Base::eliminarProducto($codigo);


header("Location:04_paginacion.php");

?>
</body>
</html>