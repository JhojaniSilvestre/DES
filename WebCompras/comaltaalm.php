<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Dar de alta almacen</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="loc_alm">Localidad:</label>
        <input type="text" name="loc_alm"><br><br>
        <input type="submit" name="submit" value="enviar">
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            require 'conexion.php'; require 'funciones_com.php';
            $loc_alm = limpiar($_POST["loc_alm"]);

            $conn = crear_conexion();

            $cod = generarCodAlm($conn);
            insertarAlmacen($conn,$cod,$loc_alm);

            cerrar_conexion($conn);
        }

/*
Alta de Almacenes (comaltaalm.php): dar de alta almacenes en diferentes localidades. El
número de almacén será un número secuencial que comenzará en 10 y se incrementará de 10
en 10.
*/
?>
</body>
</html>