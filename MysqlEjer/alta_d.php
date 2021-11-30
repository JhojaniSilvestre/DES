<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta departamento</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nombre_dept">Nombre del departamento:</label>
        <input type="text" name="nombre_dept"><br><br>
        <input type="submit" name="submit" value="enviar">
    </form>
</body>
</html>

<?php
require 'funciones.php';
require 'funciones_dept.php';

if(isset($_POST['submit'])){
    $nombre_dept = $_POST["nombre_dept"];

    $nombre_dept = limpiar($nombre_dept);
    $conn = crear_conexion();
    alta_departamento($nombre_dept, $conn);

    cerrar_conexion($conn);
}

?>