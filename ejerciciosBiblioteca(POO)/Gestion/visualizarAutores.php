<?php
    include_once("../Clases/Autor.php");
    include_once("../Clases/BD.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Autores</title>
    <link rel="stylesheet" href="../Estilos/estilo.css">
</head>
<body>
    <?php
        $arrayTotalAutores = Base::getInfoAutores();
    ?>
    <p><a href="../index.php">Volver al inicio</a></p>
    <table>
        <caption>Listado de todos los Autores</caption>
        <tr>
            <th>Nombre Autor</th>
            <th>Pais</th>
        </tr>

        <?php
            foreach($arrayTotalAutores as $autor){  
        ?>
        <tr>
            <td><?php echo $autor-> getNombreAutor();?></td>
            <td><?php echo $autor-> getPais();?></td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>