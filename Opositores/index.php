<?php
session_start();
$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
$registros = isset($_SESSION['registros']) ? $_SESSION['registros'] : [];
$form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

// Limpiar las variables de sesión
unset($_SESSION['mensaje']);
unset($_SESSION['registros']);
unset($_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opositores</title>
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="bg-dark">
    <div class="bg-dark p-4">
        <h1 class="text-white text-center p-4">DATOS DE LOS OPOSITORES</h1>
        <form action="gestiona.php" method="post">
            <div class="container text-center">
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo isset($form_data['nombre']) ? htmlspecialchars($form_data['nombre']) : ''; ?>">
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?php echo isset($form_data['apellidos']) ? htmlspecialchars($form_data['apellidos']) : ''; ?>">
                            <label for="apellidos">Apellidos</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="fNacimiento" name="fNacimiento" placeholder="FechaNacimiento" value="<?php echo isset($form_data['fNacimiento']) ? htmlspecialchars($form_data['fNacimiento']) : ''; ?>">
                            <label for="fNacimiento">Fecha de nacimiento</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating form-control">
                            <div class="form-check-inline">
                                Sexo
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoMasculino" value="Masculino" <?php echo (isset($form_data['sexo']) && $form_data['sexo'] == 'Masculino') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sexoMasculino">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sexo" id="sexoFemenino" value="Femenino" <?php echo (isset($form_data['sexo']) && $form_data['sexo'] == 'Femenino') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="sexoFemenino">Femenino</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" value="<?php echo isset($form_data['ciudad']) ? htmlspecialchars($form_data['ciudad']) : ''; ?>">
                            <label for="ciudad">Ciudad</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="cp" name="cp" placeholder="Código Postal" value="<?php echo isset($form_data['cp']) ? htmlspecialchars($form_data['cp']) : ''; ?>">
                            <label for="cp">Código Postal</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo isset($form_data['telefono']) ? htmlspecialchars($form_data['telefono']) : ''; ?>">
                            <label for="telefono">Teléfono</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" value="<?php echo isset($form_data['cantidad']) ? htmlspecialchars($form_data['cantidad']) : ''; ?>">
                            <label for="cantidad">Cantidad</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" name="action" value="guardar" class="btn btn-primary m-2">Guardar Registro</button>
                <button type="submit" name="action" value="mostrar" class="btn btn-primary m-2">Mostrar Registros</button>
                <button type="submit" name="action" value="media" class="btn btn-primary m-2">Media de edad</button>
                <button type="submit" name="action" value="menor" class="btn btn-primary m-2">Datos < edad</button>
                <button type="submit" name="action" value="mayor" class="btn btn-primary m-2">Datos > edad</button>
                <button type="submit" name="action" value="femeninos" class="btn btn-primary m-2">Opositores Femeninos</button>
                <button type="submit" name="action" value="badajoz" class="btn btn-primary m-2">Opositores de Badajoz</button>
                <button type="submit" name="action" value="cantidad" class="btn btn-primary m-2">Datos cantidad < 1000</button>
            </div>
        </form>
        <div class="text-center text-danger mt-3">
            <?php echo $mensaje; ?>
        </div>
        <div class="text-center mt-3">
        <?php if (!empty($registros)): ?>
            <h3>Registros:</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Ciudad</th>
                        <th>Código Postal</th>
                        <th>Teléfono</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($registros as $line): ?>
                        <?php 
                        // Dividir cada línea en sus componentes
                        $datos = explode('|', $line);
                        ?>
                        <tr>
                            <?php if (count($datos) >= 9):?> <td><?php echo htmlspecialchars($datos[0]); ?></td> <!-- Nombre -->
                                <td><?php echo htmlspecialchars($datos[1]); ?></td> <!-- Apellidos -->
                                <td><?php echo htmlspecialchars($datos[2]); ?></td> <!-- Fecha de Nacimiento -->
                                <td><?php echo htmlspecialchars($datos[3]); ?></td> <!-- Edad -->
                                <td><?php echo htmlspecialchars($datos[4]); ?></td> <!-- Sexo -->
                                <td><?php echo htmlspecialchars($datos[5]); ?></td> <!-- Ciudad -->
                                <td><?php echo htmlspecialchars($datos[6]); ?></td> <!-- Código Postal -->
                                <td><?php echo htmlspecialchars($datos[7]); ?></td> <!-- Teléfono -->
                                <td><?php echo htmlspecialchars($datos[8]); ?></td> <!-- Cantidad -->
                            <?php else: ?>
                                <td colspan="9" class="text-danger">Error: línea mal formateada.</td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay registros disponibles.</p>
        <?php endif; ?>
    </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>