<?php
$carton = array();
$i=0;
do{
    $numRand=rand(1,60);
    if (!in_array($numRand, $carton)) { //si el num random no se encuentra en el carton:
        $carton[$i] = $numRand; //guardo el numero en el carton
        $i++; //incremento la posicion
    }
}while(count($carton) < 15);

print_r($carton);

$aciertos=0;
$bomboAux= array(); //guardará los numeros aleatorios del bombo sin repetir
$j=0;
while ($aciertos < 15) {
    $bombo=rand(1,60);
    if(!in_array($bombo, $bomboAux)){ //si el numero aleatorio del bombo no se encuentra en bomboAux:
        $bomboAux[$j] = $bombo;//guardo el numero en bomboAux
        if (in_array($bombo, $carton)) { //si el num aleatorio del bombo se encuentra en el carton:
            $aciertos++; //incremento los aciertos
            echo "<br/>$bombo";
        }
        $j++;//incremento la posicion
    }
}
echo "<br/> ";
print_r($bomboAux);

?>
