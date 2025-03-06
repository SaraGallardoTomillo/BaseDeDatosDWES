<?php
    session_start();
    // Generar un número aleatorio de 4 dígitos si no está ya establecido
    if (!isset($_SESSION['clave'])) {
        $digits = [];
        while (count($digits) < 4) {
            $digit = rand(0, 9);
            if (!in_array($digit, $digits)) {
                $digits[] = $digit;
                $_SESSION['clave'] .= $digit;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MasterMind</title>
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stles.css">
</head>

<body class="bg-dark">
    <header class="w-auto" style="--bs-bg-opacity: .5;">
        <h1 class="text-center p-5 fw-bold">MASTERMIND</h1>
        <h5 class="text-center p-5 fw-bold">Sara Gallardo Tomillo</h5>
    </header>
    <main class="bg-dark p-4">
       <div class="d-flex justify-content-center">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                CLAVE
            </button>
    
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">CLAVE</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="d-inline-flex gap-1">
                                <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                HACER TRAMPAS
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    ¿Ya te quieres rendir?
                                    <p class="d-inline-flex gap-1">
                                        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                        SI
                                        </button>
                                    </p>
                                    <div class="collapse" id="collapseExample2">
                                        <div class="card card-body">
                                            <!-- AQUÍ PONER LA CLAVE -->
                                            <?php echo isset($_SESSION['clave']) ? $_SESSION['clave'] : 'No hay clave'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Modal --> 
       </div>
       <!-- Mostrar errores si existen -->
       <?php
            if (isset($_SESSION['errors'])) {
                echo '<div class="alert alert-danger">';
                foreach ($_SESSION['errors'] as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
                unset($_SESSION['errors']); // Limpiar errores después de mostrarlos
            }
        ?>
         <!-- Formulario -->
         <form action="gestiona.php" method="post">
            <div class="row justify-content-center p-4">
                <div class="col-2"> <!-- Cambia el tamaño de la columna -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput1"name="digit1">
                        <label for="floatingInput1">Número 1</label>
                    </div>
                </div>
                <div class="col-2"> <!-- Cambia el tamaño de la columna -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword2"name="digit2">
                        <label for="floatingPassword2">Número 2</label>
                    </div>
                </div>
                <div class="col-2"> <!-- Cambia el tamaño de la columna -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput3"name="digit3">
                        <label for="floatingInput3">Número 3</label>
                    </div>
                </div>
                <div class="col-2"> <!-- Cambia el tamaño de la columna -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword4"name="digit4">
                        <label for="floatingPassword4">Número 4</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-primary">Comprobar</button>
            </div>
        </form>
        <!-- Fin Formulario -->
         <div class="resultados text-white">
            <?php
                // Mostrar historial de jugadas
                if (isset($_SESSION['historial'])) {
                    echo "<h2>Historial de Jugadas:</h2>";
                    echo "<table class='table table-dark'>";
                    echo "<thead><tr><th>Número del Usuario</th><th>Muertos</th><th>Heridos</th><th>Intento</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($_SESSION['historial'] as $entry) {
                        echo "<tr>";
                        echo "<td>{$entry['userGuess']}</td>";
                        echo "<td>{$entry['muertos']}</td>";
                        echo "<td>{$entry['heridos']}</td>";
                        echo "<td>{$entry['intentos']}</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                }
                // Comprobar si el juego ha sido ganado
                if (isset($_SESSION['muertos']) && $_SESSION['muertos'] == "4") {
                    echo "<h3>¡Felicidades! Has adivinado el número {$_SESSION['clave']} en {$_SESSION['intentos']} intentos.</h3>";
                    echo '<form action="index.php" method="post" class="d-flex justify-content-center mb-3">';
                    echo '<button type="submit" class="btn btn-success">Volver a Jugar</button>';
                    echo '</form>';
                    session_unset(); // Limpiar todas las variables de sesión
                    session_destroy(); // Destruir la sesión
                    
                }
            ?>
         </div>
    </main>

    <script src="js/bootstrap.min.js"></script>
</body>

</html>