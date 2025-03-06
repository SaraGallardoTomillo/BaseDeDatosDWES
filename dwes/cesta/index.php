<?php

    include_once("./include/BD.php");
    // Comprobamos si ya se ha enviado el formulario
    if (isset($_POST['enviar'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
       
        if (empty($usuario) || empty($password)) 
            $error = "*Debes introducir un nombre de usuario y una contraseña";
        else {
           
             // Ejecutamos la consulta para comprobar las credenciales
            $contador=Base::getUsuario($usuario,$password);
            if ( $contador>0 ){
                    session_start();
                    $_SESSION['usuario']=$usuario;

                    header("Location: 03_usuarioCorrecto.php");                    
                }
                else {
                    // Si las credenciales no son válidas, se vuelven a pedir
                    $error = "*¡Usuario o contraseña no válidos!";
                }
               
            }
                    
        }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login usuario</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id='login'>
    <form action='index.php' method='post'>
    <fieldset >
        <legend>Login</legend>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input type='text' name='usuario' id='usuario' maxlength="50" autocomplete="off" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='text' name='password' id='password' maxlength="50" /><br/>
        </div>
        
        <div class='campo'>
            <input type='submit' name='enviar' value='Enviar' />
            <div><span class='error'><?php if  (isset($_POST['enviar'])) echo $error; ?></span></div>
        </div>
    </fieldset>
    </form>
    </div>
</body>
</html>