<?php 
   require_once 'conexion.php'; require_once 'funciones_com.php';
   //Se recuperan los valores de la sesión
   session_start();
     
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras Web</title>
    <style type = "text/css">
        nav > a {
            margin: 10px;
        }
        
    </style>
</head>
<body>
    <nav>
    <?php
        if(isset($_SESSION['id_usuario'])){
        echo "<p><a href='comlogoutcli.php'>Cerrar Sesion</a></p>";
        }
        else{
    ?>
        <a href='comlogincli.php'>Iniciar Sesión</a>
        <a href='comregcli.php'>Registrarse</a>
    <?php } ?>
    </nav>

    <div>
        <br>
        <h3>Gestión Interna General</h3>
        <ul>
            <li><a href='comaltacat.php'>Alta Categorias</a></li>
            <li><a href='comaltapro.php'>Alta de productos</a></li>
            <li><a href='comaltaalm.php'>Alta de almacenes</a></li>
            <li><a href='comaprpro.php'>Aprovisionar productos</a></li>
            <li><a href='comconstock.php'>Consulta de stock</a></li>
            <li><a href='comconsalm.php'>Consulta de Almacenes</a></li>
            <li><a href='comconscom.php'>Consulta de compras</a></li>
        </ul>
        <h3>Gestión Interna Clientes</h3>
        <ul>
            <li><a href='comaltacli.php'>Alta de clientes</a></li>
            <li><a href='compro.php'>Compra de productos</a></li>
        </ul>
    </div>
</body>
</html>