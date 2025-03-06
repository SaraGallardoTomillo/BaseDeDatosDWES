<?php
    include_once("../Clases/Autor.php");
    include_once("../Clases/BD.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores según el pais</title>
    <link rel="stylesheet" href="../Estilos/estilo.css">
</head>
<body>
    <?php
        $pais='RUSIA';
        $resultado= Base::getAutorPorPais($pais);
    ?>
    <table>
        <caption>Listado de todos los Autores</caption>
        <tr>
            <th>Nombre Autor</th>
            <th>Pais</th>
        </tr>

        <?php
            foreach($resultado as $autor){  
        ?>
        <tr>
            <td><?php echo $autor-> getNombreAutor();?></td>
        </tr>
        <?php
            }
        ?>
    </table>
    <p><a href="../index.php">Volver al inicio</a></p>
</body>
</html>