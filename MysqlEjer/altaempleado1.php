<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="dni_emp">DNI Empleado:</label>
        <input type="text" name="dni_emp"><br><br>
        <label for="nombre_emp">Nombre del empleado:</label>
        <input type="text" name="nombre_emp"><br><br>
        <label for="fnac_emp">Fecha de nacimiento:</label>
        <input type="date" name="fnac_emp"><br><br>
        <label for="dept_emp">Departamento:</label>
        <input type="text" name="dept_emp"><br><br>
        <input type="submit" name="submit" value="enviar">
    </form>
</body>
</html>

<?php

require 'funciones.php';
require 'funciones_Emp.php';

if(isset($_POST['submit'])){
    $dni_emp = limpiar($_POST["dni_emp"]);
    $nombre_emp = limpiar($_POST["nombre_emp"]);
    $fnac_emp = limpiar($_POST["fnac_emp"]);
    $dept_emp = limpiar($_POST["dept_emp"]);

    $conn = crear_conexion();
    
    alta_empleado($dni_emp,$nombre_emp,$fnac_emp,$dept_emp,$conn);

    cerrar_conexion($conn);
}

?>



