<?php
require "funcion_fichero.php";

$nombre = $_POST["nombre"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$fnacimiento = $_POST["fnacimiento"];
$localidad = $_POST["localidad"];

//var_dump($_POST);

$fechaValida = validarFecha($fnacimiento);

if ($fechaValida) {
    $nom = str_pad($nombre,40," ");
    $ape1 = str_pad($apellido1,40," ");
    $ape2 = str_pad($apellido2,41," ");
    $fnac = str_pad($fnacimiento,9," ");
    $local = str_pad($localidad,26," ");

    $alumno = $nom.$ape1.$ape2.$fnac.$local;
    $fichero = "alumnos1.txt";

    escribirFichero($fichero, $alumno);

    leerFichero($fichero);
}
else{
    echo "Fecha no valida";
}
?>
