<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca POO</title>
    <link href="../estilos/estilo.css" type="text/css" rel="stylesheet">
</head>

<body>
<?php
echo "<p>ALTA DE AUTOR EN LA BASE DE DATOS DE BIBLIOTECA</p>";
echo "<form name=form1' method='post' action='07altaautor7.2PDO.php'>";
echo "<table>";
echo "<tr>";
echo "<td>NOMBRE</td>";
echo "<td><input name='nombre' type='text' id='nombre'></td>";
echo "</tr>";
echo "<tr>";
echo "<td>PAIS</td>";
echo "<td><input name='pais' type='text' id='pais'></td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='2'><input type='submit' name='Submit' value='Alta de autor'>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";

?>
</body>

</html>

