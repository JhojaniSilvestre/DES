<?php 
   require_once 'conexion.php'; require_once 'funciones_com.php';
   //Se recuperan los valores de la sesión
   session_start();
     
?>

<html>
   
   <head>
      <title>Bienvenido/a </title>
   </head>
   
   <body>
        <?php
        if(isset($_SESSION['id_usuario'])){
        echo "<p><a href='comlogoutcli.php'>Cerrar Sesion</a></p>";
        }
        ?>
		<!-- Se muestra el nombre del usuario recuperado de una variable de sesión -->
		<h1>Bienvenido/a <?php echo $_SESSION['login_usuario']." -ID: ".$_SESSION['id_usuario']; ?></h1> 
		
		<div>
            <a href='comconscom.php'>Consulta de compras</a><br>
            <a href='compro.php'>Compra de productos</a>
		</div>		
	
   </body>
   
</html>