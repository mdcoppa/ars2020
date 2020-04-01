<?php
$alfabeto = array("A", "B", "C", "D", "E", "F", "G ", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

$mensaje = $_POST['mensaje'];
//Paso a mayusculas el mensaje para que coincida con el alfabeto.
$mensaje = strtoupper($mensaje); 
$tamano =  strlen($mensaje);
$desplazamiento = $_POST['desplazamiento'];

echo "MENSAJE A ENCRIPTAR:";
echo "</br>";
echo "<div class='a'>$mensaje</div>";
echo "</br>";
echo "</br>";
echo "DESPAZAMIENTO:";
echo "</br>";
echo "<div class='a'>$desplazamiento</div>";
echo "</br>";
echo "</br>";
echo "MENSAJE ENCRIPTADO:";

for ($pos=0; $pos <= $tamano ; $pos++) {
  //Los espacios en blanco no se modifican
  //Se asume que el mensaje solo contiene caracteres del alfabeto, se verifica la mensaje antes
  for ($i=0;$i<27;$i++) {
    if ($mensaje[$pos] == ' '){
      $resultado = " ";
    }else{
      if ($mensaje[$pos] == $alfabeto[i]) {
        $resultado =$alfabeto[(i+3)%27];
      }
    }
     echo " ", "<span style='color:red; font:bold 25px Arial;'>$resultado</apan>";
    }

}
echo "</br>","</br>","</br>";
echo "<a href='caesar.php'>Atras<a/>"; 
?>