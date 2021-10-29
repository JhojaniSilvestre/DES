<?php

function validarFecha($fecha){
    $valores = explode("/",$fecha);
    if (count($valores) == 3 && checkdate($valores[1],$valores[0],$valores[2])) {
        return true;
    }
    else{
        return false;
    }
}

function escribirFichero($fichero, $alumno){
    file_put_contents($fichero, $alumno.PHP_EOL , FILE_APPEND | LOCK_EX);
}

function leerFichero($fichero){
    $fileLeer = fopen($fichero, "r") or die("No es posible abrir el fichero");

    while(!feof($fileLeer)) {
        echo fgets($fileLeer) . "<br>";
    }
    fclose($fileLeer);
}


?>