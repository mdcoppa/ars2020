<?php
$alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$mensaje = $_POST['mensaje'];
//Paso a mayusculas el mensaje para que coincida con el alfabeto.
$mensaje = strtoupper($mensaje); 
$tamano =  strlen($mensaje);
$desplazamiento = $_POST['desplazamiento'];

echo "<b>MENSAJE A ENCRIPTAR:</b>";
echo "</br>";
echo "<div class='a'>$mensaje</div>";
echo "</br>";
echo "</br>";
echo "<b>DESPAZAMIENTO:</b>";
echo "</br>";
echo "<div class='a'>$desplazamiento</div>";
echo "</br>";
echo "</br>";
echo "<b>MENSAJE ENCRIPTADO:</b>";
echo "</br>";

for ($pos=0; $pos < $tamano; $pos++) {
  //Los espacios en blanco no se modifican
  //Se asume que el mensaje solo contiene caracteres del alfabeto, se verifica la mensaje antes
  $resultado = "";
  for ($i=0; $i < 27; $i++) {
    if (strcmp($mensaje[$pos], ' ') == 0){
      $resultado = " ";
    }else{
      if (strcmp($mensaje[$pos], $alfabeto[$i]) == 0) {
        $resultado =$alfabeto[($i+$desplazamiento)%27];
      }
    }
  }
  echo $resultado;
}
echo "</br>","</br>","</br>";
echo "<a href='caesar.php'>Atras<a/>"; 
?>