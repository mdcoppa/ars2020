<?php
  include("caesar.php");

$mensaje = $_POST['mensaje'];
//Paso a mayusculas el mensaje para que coincida con el alfabeto.
$mensaje = strtoupper($mensaje); 
$desplazamiento = $_POST['desplazamiento'];
$boton = $_POST["boton"];

$cifrado = new caesar();

$txt_cifrado="";
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

if ($boton == "e") {
  $txt_cifrado = $cifrado->encriptar($mensaje, $desplazamiento);
} 
if ($boton == "d") {
  $txt_cifrado = $cifrado->desencriptar($mensaje, $desplazamiento);
}


//echo $cifrado->encriptar($mensaje, $desplazamiento);
echo "<div class='a'>$txt_cifrado  </div>";
echo "</br>","</br>","</br>";
echo "<a href='caesar.php'>Atras<a/>"; 
?>