<?php
session_start();

// Inicializar un array para almacenar errores
$errors = [];

// Recuperar la entrada del usuario
$d1 = $_POST['digit1'] ?? null;
$d2 = $_POST['digit2'] ?? null;
$d3 = $_POST['digit3'] ?? null;
$d4 = $_POST['digit4'] ?? null;

// Validar cada dígito
if (!isset($d1) || $d1 < 0 || $d1 > 9) {
    $errors['digit1'] = "El dígito 1 debe estar entre 0 y 9.";
}
if (!isset($d2) || $d2 < 0 || $d2 > 9) {
    $errors['digit2'] = "El dígito 2 debe estar entre 0 y 9.";
}
if (!isset($d3) || $d3 < 0 || $d3 > 9) {
    $errors['digit3'] = "El dígito 3 debe estar entre 0 y 9.";
}
if (!isset($d4) || $d4 < 0 || $d4 > 9) {
    $errors['digit4'] = "El dígito 4 debe estar entre 0 y 9.";
}


// Si hay errores, redirigir a index.php con los errores
if (!empty($errors)) {
    $_SESSION['errors'] = $errors; // Guardar errores en la sesión
    header('Location: index.php'); // Redirigir a index.php
    exit;
}

// Si no hay errores, continuar con la lógica del juego
$userGuess = $d1 . $d2 . $d3 . $d4;
// Inicializar contadores
$muertos = 0;
$heridos = 0;

// Crear un array para marcar los dígitos que ya han sido contados
$contadosClave = array_fill(0, 4, false); // Para la clave
$contadosUsuario = array_fill(0, 4, false); // Para la entrada del usuario

// Comprobar "muertos"
for ($i = 0; $i < 4; $i++) {
    if ($userGuess[$i] == $_SESSION['clave'][$i]) {
        $muertos++;
        $contadosClave[$i] = true; // Marcar este índice como contado en la clave
        $contadosUsuario[$i] = true; // Marcar este índice como contado en el usuario
    }
}

// Comprobar "heridos"
for ($i = 0; $i < 4; $i++) {
    if (!$contadosUsuario[$i]) { // Solo contar si no ha sido contado como "muerto"
        for ($j = 0; $j < 4; $j++) {
            if ($userGuess[$i] == $_SESSION['clave'][$j] && !$contadosClave[$j]) {
                $heridos++;
                $contadosClave[$j] = true; // Marcar este índice como contado en la clave
                break; // Salir del bucle una vez que se cuenta un herido
            }
        }
    }
}

// Almacenar los resultados en la sesión
$_SESSION['muertos'] = $muertos;
$_SESSION['heridos'] = $heridos;

// Incrementar el contador de intentos
$_SESSION['intentos'] = ($_SESSION['intentos'] ?? 0) + 1;

// Almacenar resultados en la sesión
$result = [
    'userGuess' => $userGuess,
    'muertos' => $muertos,
    'heridos' => $heridos,
    'intentos' => $_SESSION['intentos']
];

// Agregar el resultado al historial de jugadas
$_SESSION['historial'][] = $result;

// Redirigir a index.php para mostrar resultados
header('Location: index.php');
exit;
?>