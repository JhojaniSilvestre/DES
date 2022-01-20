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
    $productos = obtener_productos($conn);
?>
    <h3>Consulta de Stock</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="id_pro">Producto:</label>
        <select name="id_pro">
            <!--recorro el array nombreProductos -->
            <?php foreach($productos as $id => $nom_pro) : ?>
                <?php echo "<option value='".$id."'>".$nom_pro."</option>"; ?>
            <?php endforeach; cerrar_conexion($conn);?>
        </select><br><br>
        <input type="submit" name="submit" value="enviar"><br><br>
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id_pro = limpiar($_POST["id_pro"]);

            $conn = crear_conexion();

            consult_stock_pro($conn,$id_pro);

            cerrar_conexion($conn);
        }

/*
Consulta de Stock (comconstock.php): se mostrarán los productos en un desplegable y se
mostrará la cantidad disponible del producto seleccionado en cada uno de los almacenes

*/



?>
</body>
</html>