<html>
   <head>
   </head>
   <body>
       <h1> CRIPTOGRAFICA SIMETRICA </h1>
       <h2> Cifrador/Descifrador Caesar </h2>
       <form action="test_caesar.php" method="POST">
            Acción: <select name="opciones">
                <option value=0>Cifrar</option>
                <option value=1>Descifrar</option>
                <option value=2>Crack</option>
            </select>
            <br>
            <br>
            Clave: <input type="text" name="clave" style=" width:50;"/>
            <br>
            <br>
            Mensaje: <input type="text" name="mensaje" style="width:385px;"/>
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
        
        echo "Mensaje Original: " . $men;
        echo "<br>";

        switch($opcion){
            case 0: 
                echo "Mensaje Cifrado: " . $cifrado->encriptar($men, $clave);
                break;
            case 1:
                echo "Mensaje Descifrado: " . $cifrado->desencriptar($men, $clave);
                break;
            case 2:
                $cifrado->crackfb($men);
                break ;

        }
        
    }
?>