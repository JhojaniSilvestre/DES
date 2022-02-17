<?php
echo "Inicio login controller"."<br>";

//cerrar sesión si ya está actualmente activa
if(isset($_SESSION['usuario'])){
    session_unset();
    session_destroy();
}

//Llamada a la vista login para recoger datos del formulario-- Intermediario entre vista y modelo !!!
require_once("views/login_view.php");

//si el formulario se ha enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$usuario = limpiar($_POST["email"]);
$clave = strtoupper((limpiar($_POST["password"])));
//var_dump($_POST);

//abro conexion, viene de index
$conn = crear_conexion();

//Llamada al modelo para hacer la select que comprueba el login-- Intermediario entre vista y modelo !!!
require_once("models/login_model.php");

$resultado = loginUsuario($conn,$usuario,$clave);

//variable que contendra el mensaje de error
$mensaje = "";
//si la select es correcta
if ($resultado) {
    // Se crea sesión y variables de sesión
    session_start();
    $_SESSION['usuario'] = $resultado["email"];
    $_SESSION['clave'] = $resultado["last_name"];
       
    //header("location: ./inicio.php");
}
else // si no son correctos -> muestra mensaje de error
{ 
    $mensaje = "Usuario o contraseña incorrectos !!!";
    
}

//Llamada a la vista inicio-- Intermediario entre vista y modelo !!!
require_once("views/inicio_view.php");

//cierro conexion bbdd 
cerrar_conexion($conn);
echo "Fin controller"."<br>";

}//fin if post
?>