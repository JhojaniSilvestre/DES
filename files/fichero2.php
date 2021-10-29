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
    $caracter = "##";
    $nom = $nombre.$caracter;
    $ape1 = $apellido1.$caracter;
    $ape2 = $apellido2.$caracter;
    $fnac = $fnacimiento.$caracter;
    $local = $localidad.$caracter;

    $alumno = $nom.$ape1.$ape2.$fnac.$local;
    $fichero = "alumnos2.txt";

    escribirFichero($fichero, $alumno);

    leerFichero($fichero);
}
else{
    echo "Fecha no valida";
}
?>