<?php
// Nombre del archivo donde se almacenarán los registros
$filename = 'registros.txt';

// Inicializar variables
$mensaje = '';
$registros = [];
$errores = []; // Inicializar el array de errores

// Inicializar variables para mantener los valores del formulario
$nombre = '';
$apellidos = '';
$fNacimiento = '';
$sexo = 'Masculino'; // Valor por defecto
$ciudad = '';
$cp = '';
$telefono = '';
$cantidad = '';

// Comprobar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogida de los datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $fNacimiento = trim($_POST['fNacimiento']);
    $sexo = $_POST['sexo'];
    $ciudad = trim($_POST['ciudad']);
    $cp = trim($_POST['cp']);
    $telefono = trim($_POST['telefono']);
    $cantidad = trim($_POST['cantidad']);
    
    // Acción a realizar
    $action = $_POST['action'];

    // Validar campos solo si la acción es 'guardar'
    if ($action == 'guardar') {
        if (empty($nombre)) {
            $errores[] = 'El campo Nombre es obligatorio.';
        }
        if (empty($apellidos)) {
            $errores[] = 'El campo Apellidos es obligatorio.';
        }
        if (empty($fNacimiento)) {
            $errores[] = 'El campo Fecha de Nacimiento es obligatorio.';
        }
        if (empty($ciudad)) {
            $errores[] = 'El campo Ciudad es obligatorio.';
        }
        if (empty($cp)) {
            $errores[] = 'El campo Código Postal es obligatorio.';
        }
        if (empty($telefono)) {
            $errores[] = 'El campo Teléfono es obligatorio.';
        }
        if (empty($cantidad)) {
            $errores[] = 'El campo Cantidad es obligatorio.';
        }

        // Si hay errores, concatenar mensajes y no continuar con el guardado
        if (!empty($errores)) {
            $mensaje = implode('<br>', $errores);
        } else {
            // Calcular la edad
            $edad = date_diff(date_create($fNacimiento), date_create('today'))->y;

            // Guardar registro en el archivo en el orden especificado
            $registro = "$nombre|$apellidos|$fNacimiento|$edad|$sexo|$ciudad|$cp|$telefono|$cantidad\n";
            file_put_contents($filename, $registro, FILE_APPEND);
            $mensaje = 'Registro guardado correctamente.';

            // Limpiar los campos después de guardar
            $nombre = '';
            $apellidos = '';
            $fNacimiento = '';
            $sexo = 'Masculino'; // Valor por defecto
            $ciudad = '';
            $cp = '';
            $telefono = '';
            $cantidad = '';
        }
    }

    // Aquí comienza la evaluación de otras acciones
    if ($action == 'mostrar') {
        // Mostrar registros
        if (file_exists($filename)) {
            $registros = file($filename, FILE_IGNORE_NEW_LINES);
        }
    } elseif ($action == 'media') {
        // Calcular media de edad
        if (file_exists($filename)) {
            $totalEdad = 0;
            $count = 0;
            foreach (file($filename) as $line) {
                list(, , $fNacimiento) = explode('|', $line);
                $edad = date_diff(date_create($fNacimiento), date_create('today'))->y;
                $totalEdad += $edad;
                $count++;
            }
            $mediaEdad = $count > 0 ? $totalEdad / $count : 0;
            $mensaje = "La media de edad es: " . round($mediaEdad, 2);
        }
    } elseif ($action == 'menor') {
        // Mostrar persona de menor edad
        if (file_exists($filename )) {
            $menorEdad = PHP_INT_MAX;
            $personaMenor = '';
            foreach (file($filename) as $line) {
                list($nombre, $apellidos, $fNacimiento) = explode('|', $line);
                $edad = date_diff(date_create($fNacimiento), date_create('today'))->y;
                if ($edad < $menorEdad) {
                    $menorEdad = $edad;
                    $personaMenor = "$nombre $apellidos (Edad: $menorEdad)";
                }
            }
            $mensaje = "La persona de menor edad es: " . $personaMenor;
        }
    } elseif ($action == 'mayor') {
        // Mostrar persona de mayor edad
        if (file_exists($filename)) {
            $mayorEdad = 0;
            $personaMayor = '';
            foreach (file($filename) as $line) {
                list($nombre, $apellidos, $fNacimiento) = explode('|', $line);
                $edad = date_diff(date_create($fNacimiento), date_create('today'))->y;
                if ($edad > $mayorEdad) {
                    $mayorEdad = $edad;
                    $personaMayor = "$nombre $apellidos (Edad: $mayorEdad)";
                }
            }
            $mensaje = "La persona de mayor edad es: " . $personaMayor;
        }
    } elseif ($action == 'femeninos') {
        if (file_exists($filename)) {
            foreach (file($filename) as $line) {
                $datos = explode('|', $line);
                if (count($datos) >= 9) {
                    list($nombre, $apellidos, $fNacimiento, $edad, $sexo, $ciudad, $cp, $telefono, $cantidad) = array_map('trim', $datos);
                    if (strcasecmp($sexo, 'Femenino') === 0) {
                        $registros[] = "$nombre|$apellidos|$fNacimiento|$edad|$sexo|$ciudad|$cp|$telefono|$cantidad";
                    }
                }
            }
            $mensaje = empty($registros) ? "No hay opositores femeninos registrados." : '';
        }
    }
    
    elseif ($action == 'badajoz') {
        if (file_exists($filename)) {
            foreach (file($filename) as $line) {
                $datos = explode('|', $line);
                if (count($datos) >= 9) {
                    list($nombre, $apellidos, $fNacimiento, $edad, $sexo, $ciudad, $cp, $telefono, $cantidad) = array_map('trim', $datos);
                    if (strcasecmp($ciudad, 'Badajoz') === 0) {
                        $registros[] = "$nombre|$apellidos|$fNacimiento|$edad|$sexo|$ciudad|$cp|$telefono|$cantidad";
                    }
                }
            }
            $mensaje = empty($registros) ? "No hay opositores de Badajoz registrados." : '';
        }
    }
    
    elseif ($action == 'cantidad') {
        if (file_exists($filename)) {
            foreach (file($filename) as $line) {
                $datos = explode('|', $line);
                if (count($datos) >= 9) {
                    list($nombre, $apellidos, $fNacimiento, $edad, $sexo, $ciudad, $cp, $telefono, $cantidad) = array_map('trim', $datos);
                    if ((int)$cantidad < 1000) {
                        $registros[] = "$nombre|$apellidos|$fNacimiento|$edad|$sexo|$ciudad|$cp|$telefono|$cantidad";
                    }
                }
            }
            $mensaje = empty($registros) ? "No hay opositores con cantidad menor a 1000." : '';
        }
    }
    
}

// Redirigir a index.php con los resultados
session_start();
$_SESSION['mensaje'] = $mensaje;
$_SESSION['registros'] = $registros;
$_SESSION['form_data'] = [
    'nombre' => $nombre,
    'apellidos' => $apellidos,
    'fNacimiento' => $fNacimiento,
    'sexo' => $sexo,
    'ciudad' => $ciudad,
    'cp' => $cp,
    'telefono' => $telefono,
    'cantidad' => $cantidad,
];
header('Location: index.php');
exit();
?>