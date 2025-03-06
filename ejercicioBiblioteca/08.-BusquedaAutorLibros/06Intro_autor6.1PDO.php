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
echo "<p><h2>Nombre del autor</h2></p>";
echo "<table>";
echo "<tr>";
echo "<td scope='col'>Introduzca el nombre del autor a buscar (o contenga la palabra):</td>";
echo "</tr>";
echo "<form name='form1' method='post' action='06buscarautores6.2PDO.php'>";
echo "<tr>";
echo "<td><input name='palabra' type='text' id='palabra'></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type='submit' name='Submit' value='Buscar'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";
?>
</body>

</html>

