<?php
/*Jhojani Silvestre Beltrán */

//$empresa = array(array()); 
$nombreEmp = "empresa";

for ($i=0; $i < 35; $i++) { //Relleno el array 35 x 9
    $datoRandom= rand(10, 30);
    $empresa[$nombreEmp.($i+1)] = array("indice1"=>$datoRandom, "indice2"=>$datoRandom, "indice3" => $datoRandom,
     "indice4" => $datoRandom, "indice5" => $datoRandom, "indice6" => $datoRandom, "indice7" => $datoRandom
     , "indice8" => $datoRandom);   
}

foreach ($empresa as $nombreEmp => $valor) { //imprimo el array
    echo "$nombreEmp | ";
    foreach ($valor as $key => $value) {
        echo "$key: $value | ";
    }
    echo "<br />";
}

?>
