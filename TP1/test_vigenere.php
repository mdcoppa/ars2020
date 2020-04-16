<html>
   <head>
   </head>
   <body>
        <h1> CRIPTOGRAFIA SIMETRICA </h1>
        <h2> Cifrador/Descifrador Vigenere </h2>
       <form action="test_vigenere.php" method="POST">
            Acción: <select name="opciones">
                <option value=0>Cifrar</option>
                <option value=1>Descifrar</option>
            </select>
            <br>
            <br>
            Clave: <input type="text" name="clave" pattern= "^[a-zA-Z,ñ,Ñ\s]{1,254}" style=" width:385px;"/>
            <br>
            <br>
            Mensaje: <input type="text" name="mensaje" pattern= "^[a-zA-Z,ñ,Ñ\s]{1,254}" style="width:385px;"/>
            <br>
            <br>
          <button type="submit" name="procesar" value="Procesar">Procesar</button>
        </form>
    </body>
</html>

<?php
    include("vigenere.php");
    $cifrado = new vigenere();
   
    if (isset($_REQUEST['procesar'])){
        if ($cifrado->validar_clave($_REQUEST['clave'])){
            if ($cifrado->validar_mensaje($_REQUEST['mensaje'])){
                $clave = strtoupper($_REQUEST['clave']);
                $men = strtoupper($_REQUEST['mensaje']);
                $opcion = $_REQUEST['opciones'];
                $result='';
                
                echo "Mensaje Original: " . $men;
                echo "<br>";

                switch($opcion){
                    case 0:echo "Mensaje Cifrado: " . $cifrado->cifrar($men, $clave);break;
                    case 1:echo "Mensaje Descifrado: " . $cifrado->descifrar($men, $clave);break;
                }
            }
        }
        
    }
?>