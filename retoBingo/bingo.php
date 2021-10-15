
<?php

//relleno el array jugadores 
$cont=0;
$carton = array();
for ($i=0; $i < 12; $i++) {
    $j=0;
    $k=1;
    if ($i % 3 == 0) {
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
