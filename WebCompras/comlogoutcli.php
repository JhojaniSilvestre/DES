<?php
session_start();
session_unset();
session_destroy();
?>
<html>
<head>
<meta charset="UTF-8"/>
<title>Cerrar Sesión</title>
</head>
<body>
<p>Has Cerrado Sesión</p>
<br /><a href="comlogincli.php">Volver a Login</a><br>
<a href='inicio.php'>Volver a inicio</a>
</body>
</html>