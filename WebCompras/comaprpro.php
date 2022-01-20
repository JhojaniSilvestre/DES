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
    $productos = obtener_productos($conn);
?>
    <h3>Aprovisionar productos</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="num_alm">Número de almacen:</label>
        <select name="num_alm">
            <!--recorro el array imprimiendo la categoria -->
            <?php foreach($almacenes as $almacen) : ?>
                <option><?php echo $almacen; ?></option>
            <?php endforeach;?>
        </select>
        <label for="id_pro">Producto:</label>
        <select name="id_pro">
            <!--recorro el array nombreProductos -->
            <?php foreach($productos as $id => $nom_pro) : ?>
                <?php echo "<option value='".$id."'>".$nom_pro."</option>"; ?>
            <?php endforeach; cerrar_conexion($conn);?>
        </select><br><br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad"><br><br>
        <input type="submit" name="submit" value="enviar"><br><br>
    </form>
    <br><a href='inicio.php'>Volver a inicio</a>
<?php //una vez que el form ha sido enviado
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $num_alm = limpiar($_POST["num_alm"]);
            $id_pro = limpiar($_POST["id_pro"]);
            $cantidad = limpiar($_POST["cantidad"]);

            $conn = crear_conexion();

            aprov_productos($conn,$num_alm,$id_pro,$cantidad);

            cerrar_conexion($conn);
        }

/*
Aprovisionar Productos (comaprpro.php): asignar una cantidad de un determinado producto
a un almacén. Se seleccionarán los nombres de los productos y los números de los almacenes
desde listas desplegables. El usuario introducirá la cantidad del producto a aprovisionar.
*/
?>
</body>
</html>