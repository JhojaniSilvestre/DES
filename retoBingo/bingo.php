<?php
$carton = array();
$numRandAux = array();
$i=0;
do{
    $numRand=rand(1,60);
    if (!in_array($numRand, $numRandAux)) {
        $numRandAux[$i] = $numRand;
        $carton[$i] = $numRand; 
        $i++;
    }
}while(count($carton) < 15);

print_r($carton);

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

?>
