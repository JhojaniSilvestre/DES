<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require_once 'conexion.php'; require_once 'funciones_com.php';
    $conn = crear_conexion();
    $clientes = obtenerNif($conn);
?>
    <h3>Consulta Almacenes</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="nif">NIF Clientes:</label>
        <select name="nif">
            <!--recorro el array imprimiendo la categoria -->
            <?php foreach($clientes as $nif) : ?>
                <option><?php echo $nif; ?></option>
            <?php endforeach;?>
        </select><br><br>
        <label for="f_desde">Fecha desde:</label>
        <input type="date" name="f_desde"><br><br>
        <label for="f_hasta">Fecha hasta:</label>
        <input type="date" name="f_hasta"><br><br>
        <input type="submit" name="submit" value="enviar"><br><br>
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nif = limpiar($_POST["nif"]);
            $f_desde = limpiar($_POST["f_desde"]);
            $f_hasta = limpiar($_POST["f_hasta"]);
            
            $conn = crear_conexion();

            consult_com_cli($conn,$nif,$f_desde,$f_hasta);
            total_compras_cli($conn,$nif,$f_desde,$f_hasta);
            cerrar_conexion($conn);
        }





/*
Consulta de Compras (comconscom.php): se mostrarán en un desplegable los NIF de los
clientes, una fecha desde y una fecha hasta. Se mostrará por pantalla la información de las
compras realizadas por los clientes en ese periodo (producto, nombre producto, precio compra)
así como el montante total de todas las compras

*/
?>
</body>
</html>