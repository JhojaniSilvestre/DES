<?php

//relleno el array jugadores 
$cont=0;
$carton = array();
for ($i=0; $i < 12; $i++) { //total de cartones por cada jugador, en este caso 4 jugadores cada uno con 3 cartones
    $j=0;
    $k=1;
    if ($i % 3 == 0) { //esto controla cuantos cartones tiene un jugador
        $jugadores[$i][$j] = "jugador".$cont++;
    }
    $jugadores[$i][$j] = "jugador".$cont;

    do{
        $numRand=rand(1,60);
        if (!in_array($numRand, $carton)) {
            $carton[$j] = $numRand;
            $jugadores[$i][$k++] =  $numRand;
            $j++;
        }
    }while(count($carton) < 15);
    $carton = array();
}
var_dump($jugadores);
echo "<br>";

//otra forma de visualizar en cuadrado

for ($i = 0; $i < sizeof($jugadores); $i++) {
    for ($j = 0; $j < sizeof($jugadores[0]); $j++){
        echo $jugadores[$i][$j]."\n";
    }
    echo "<br>";
}


$bomboAux= array();
$jugadorWin;
$aciertos = 0;
$b=0;
while ($aciertos < 15) {
    $bombo=rand(1,60);
    if(!in_array($bombo, $bomboAux)){
        $bomboAux[$b] = $bombo;
        for ($i = 0; $i < sizeof($jugadores); $i++) {
            for ($j = 0; $j < sizeof($jugadores[0]); $j++){
                if($jugadores[$i][$j] == $bomboAux[$b]){
                    $aciertos++;
                    $jugadorWin = $jugadores[$i][0];
                    echo "<br/> bola: $bombo  "; //
                    echo " ".$jugadorWin;
                }
            }
        }
        $b++;
    }
}
echo "<br>";



/*
$aciertos=0;
$bomboAux= array();
$j=0;
while ($aciertos < 15) {
    $bombo=rand(1,60);
    if(!in_array($bombo, $bomboAux)){
        $bomboAux[$j] = $bombo;
        if (in_array($bombo, $carton)) {
            $aciertos++;
            echo "<br/>$bombo";
        }
        $j++;
    }
}
echo "<br/> ";
print_r($bomboAux);
*/

?>
