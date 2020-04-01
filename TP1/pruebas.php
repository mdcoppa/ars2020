<?php
$alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$cadena= "";
for ($i=0; $i < 10 ; $i++) {
    $cadena .= $alfabeto[$i];

}
echo $cadena;
?>