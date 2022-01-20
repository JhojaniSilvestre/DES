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
    $almacenes = obtenerNumAlm($conn);
?>
    <h3>Consulta Almacenes</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="num_alm">Número de almacen:</label>
        <select name="num_alm">
            <!--recorro el array imprimiendo la categoria -->
            <?php foreach($almacenes as $almacen) : ?>
                <option><?php echo $almacen; ?></option>
            <?php endforeach;?>
        </select>
        <input type="submit" name="submit" value="enviar"><br><br>
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $num_alm = limpiar($_POST["num_alm"]);

            $conn = crear_conexion();

            consult_pro_alm($conn,$num_alm);

            cerrar_conexion($conn);
        }

/*
Consulta de Almacenes (comconsalm.php): se mostrarán los almacenes en un desplegable
y se mostrará la información de los productos disponibles en el almacén seleccionado

*/
?>
</body>
</html>