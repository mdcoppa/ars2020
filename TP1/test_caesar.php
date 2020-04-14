<html>
   <head>
   </head>
   <body>
       <h1> CRIPTOGRAFIA SIMETRICA </h1>
       <h2> Cifrador/Descifrador Caesar </h2>
       <form action="test_caesar.php" method="POST">
            Acción: <select name="opciones">
                <option value=0>Cifrar</option>
                <option value=1>Descifrar</option>
                <option value=2>Fuerza Bruta</option>
            </select>
            <br>
            <br>
            Clave: <input type="number" name="clave" pattern= "^[0-9]" style=" width:50;"/>
            <br>
            <br>
            Mensaje: <input type="text" name="mensaje" pattern= "^[a-zA-Z\s]{1,254}" style="width:385px;"/>
            <br>
            <br>
          <button type="submit" name="procesar" value="Procesar">Procesar</button>
        </form>
    </body>
</html>

<?php
    include("caesar.php");

    $cifrado = new caesar();

    if (isset($_REQUEST['procesar'])){
        $clave = $_REQUEST['clave'];
        $men = strtoupper($_REQUEST['mensaje']);
        $opcion = $_REQUEST['opciones'];
        $result='';
                
        echo "<br>";
        echo "<br>";
        echo "** Mensaje: " . $men;
        echo "<br>";

        switch($opcion){
            case 0: 
                if ($cifrado->validar_clave($clave)){
                    if ($cifrado->validar_mensaje($men)){
                        echo "** Mensaje Cifrado: " . $cifrado->encriptar($men, $clave);
                    }
                }
                break;
            case 1:
                if ($cifrado->validar_clave($clave)){
                    if ($cifrado->validar_mensaje($men)){
                        echo "** Mensaje Descifrado: " . $cifrado->desencriptar($men, $clave);
                    }
                }
                break;
            case 2:
                if ($cifrado->validar_mensaje($men)){
                    echo $cifrado->crackfb($men);
                }
                break;
        }
    }
?>