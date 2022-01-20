<?php //una vez que el form ha sido enviado
        require_once 'conexion.php'; require_once 'funciones_com.php';
        
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $usuario = limpiar($_POST["nombre"]);
            $clave = strrev(limpiar($_POST["clave"])); 

            $conn = crear_conexion();

            $mensaje = loginUsuario($conn,$usuario,$clave);

            cerrar_conexion($conn);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login cliente</title>
</head>
<body>
    <?php if (!empty($mensaje)): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <h3>Login cliente</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nombre">Nombre usuario:</label>
        <input type="text" name="nombre"><br><br>
        <label for="clave">contraseña:</label>
        <input type="text" name="clave"><br><br>
        <input type="submit" name="submit" value="enviar">
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>

</body>
</html>