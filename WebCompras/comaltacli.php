<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta cliente</title>
</head>
<body>
    <h3>Dar de alta cliente</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nif">NIF:</label>
        <input type="text" name="nif"><br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br><br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido"><br><br>
        <label for="cp">CP:</label>
        <input type="text" name="cp"><br><br>
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion"><br><br>
        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad"><br><br>
        <input type="submit" name="submit" value="enviar">
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        require_once 'conexion.php'; require_once 'funciones_com.php';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nif = limpiar($_POST["nif"]);
            $nombre = limpiar($_POST["nombre"]);
            $apellido = limpiar($_POST["apellido"]);
            $cp = limpiar($_POST["cp"]);
            $direccion = limpiar($_POST["direccion"]);
            $ciudad = limpiar($_POST["ciudad"]);

            $conn = crear_conexion();

            $nifValido = validarNIF($nif);

            if ($nifValido) {
                altaCliente($conn, $nif,$nombre,$apellido,$cp,$direccion,$ciudad);
            }

            cerrar_conexion($conn);
        }

/*
Alta de Clientes (comaltacli.php): dar de alta un cliente. Se validará que el campo NIF no está
vacío y que se compone de 8 dígitos más una letra. Además, se controlará mediante el
correspondiente mensaje de error que no se dan de alta dos clientes con el mismo NIF
*/
?>
</body>
</html>