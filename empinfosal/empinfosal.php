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
        <select name="dept_emp">
            <?php require_once 'conexion.php'; require_once 'f_empinfosal.php';
                $conn = crear_conexion();
                if (!isset($_POST) || empty($_POST)) {
                    $departamentos = obtener_Departamentos($conn);
				}
            ?>
            <?php foreach($departamentos as $departamento) : ?>
                <option> <?php echo $departamento ?> </option>
            <?php endforeach; cerrar_conexion($conn);?>
        </select>
        <input type="submit" name="submit" value="enviar">
    </form>
<?php
        if(isset($_POST["submit"])){ 
            $dept_emp = limpiar($_POST["dept_emp"]);
            $conn = crear_conexion();
            salarioEmpDept($conn, $dept_emp);
            sumaSalario($conn, $dept_emp);
            cerrar_conexion($conn);
        }
?>
</body>
</html>