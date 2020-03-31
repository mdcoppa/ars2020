<?php
$mensaje = $_POST['mensaje'];
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
echo "MENSAJE ENCRIPTADO:", "
";
for ($pos=0; $pos <= $tamano ; $pos++) {
 $resultado1 = $mensaje[$pos];
  /*if ($resultado1 == X) {
   echo " ","<span style='color:red; font:bold 25px Arial;'>AAA</apan>";
  }else{
   if ($resultado1 == Y) {
   echo " ","<span style='color:red; font:bold 25px Arial;'>B</apan>";
   }else{
    if ($resultado1 == Z) {
    echo " ","<span style='color:red; font:bold 25px Arial;'>C</apan>";
    }else{
      */
    $i = (ord($resultado1)+3) % 27;
    $j = ord($resultado1);
    
    $resultado = chr($i);
    echo " ", "<span style='color:red; font:bold 25px Arial;'>$resultado1 : $j: $i</apan>";
    /*
     for ($i=65;$i<=90;$i++) {
      $letra = chr($i);
      if ($resultado1 == $letra) {
       $i = $i + 3;
       $resultado =chr($i);
       echo " ", "<span style='color:red; font:bold 25px Arial;'>$resultado</apan>";
      }               
     }
     */
    //}
   //}
  //}
}
echo "</br>","</br>","</br>";
echo "<a href='caesar.php'>Atras<a/>"; 
?>