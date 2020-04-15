<?php
  function mod($a, $n) {
    return ($a % $n) + ($a < 0 ? $n : 0);
  }
  class Caesar {
        //Alfabeto a utilizar por la clase (solo se cifran los caracteres del alfabeto)
        private $alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

        //Funcion para validar el mensaje de entrada
        public function validar_mensaje($mensaje){
          if (empty(trim($mensaje))){
            echo "Debe escribir un mensaje. <br>";
            return false;
          }
          
          return true;
        }

        //Funcion para validar la clave que se utiliza para cifrar
        public function validar_clave($clave){
          if (empty(trim($clave))){
            echo "Debe escribir una clave. <br>";
            return false;
          }
          return true;
        }

        
        //Funcion para cifrar el mensaje segun la clave (o desplazamiento) dada
        public function encriptar($mensaje, $key){
            $tamano =  strlen($mensaje);
            $resultado = '';

            for ($pos=0; $pos < $tamano; $pos++) {
                //Los espacios en blanco no se modifican
                //Se asume que el mensaje solo contiene caracteres del alfabeto, se verifica la mensaje antes
                
                for ($i=0; $i < 27; $i++) {
                  if (strcmp($mensaje[$pos], ' ') == 0){
                    $resultado .= ' ';
                  }else{
                    if (ord($mensaje[$pos]) == ord($this->alfabeto[$i])) {
                      $resultado .= $this->alfabeto[($i+$key)%27];
                    }
                  }
                }
              
            }
            return $resultado;
          }


        //Funcion para descifrar el mensaje segun la clave (o desplazamiento) dada
        public function desencriptar($mensaje, $key){
          $tamano =  strlen($mensaje);
          $resultado = '';

          for ($pos=0; $pos < $tamano; $pos++) {
              //Los espacios en blanco no se modifican
              //Se asume que el mensaje solo contiene caracteres del alfabeto, se verifica la mensaje antes
              for ($i=0; $i < 27; $i++) {
                if (strcmp($mensaje[$pos], ' ') == 0){
                  $resultado .= ' ';
                }else{
                 if (ord($mensaje[$pos]) == ord($this->alfabeto[$i])) {
                  $resultado .= $this->alfabeto[mod($i-$key,27)];
                  }
                }
              }
          }
          return $resultado;
        }

        public function crackfb($mensaje){
            $plaintexts = [];
            $sugerencias = [];    //Arreglo donde guardo las keys con mayores ocurrencias.


            $palabras_mensaje = explode(" ", $mensaje);


            //For para probar con todas las claves (o desplazamientos posibles)
            foreach (range(0, 26) as $key) {
              $nro_ocurrencias=0;
              foreach($palabras_mensaje as $pal_mensaje){
                $msg_aux = $this->desencriptar($pal_mensaje, $key);
                
                $fp = fopen("diccionario.txt", "r");
                //Recorro cada palabra del diccionario y me fijo cuantas veces aparece en la palabra desencriptada
                while (!feof($fp)){
                  $palabra_dicc = trim(fgets($fp));
                  if (!empty($palabra_dicc)){                 //por si hay lineas en blanco en el diccionario
                    if (strcasecmp($msg_aux, $palabra_dicc) == 0){
                      $nro_ocurrencias++;
                    }
                  }
                }
                fclose($fp);

                //Asigno el maximo nro de ocurrencias para la $key
                $plaintexts[$key] = $nro_ocurrencias;
              }
            }

              
            //Encuentro la clave que tiene mas apariciones
            // Si mas de una clave tiene la misma cantidad de apariciones maxima, queda guardada en $sugerencias
            $sugerencias = array_keys($plaintexts,max($plaintexts));

            // Imprimo todas las sugerencias encontradas
            echo "<br><br>Sugerencias: <br>";

            foreach ($sugerencias as $valor_sug) {
              $found_msg =  $this->desencriptar($mensaje, $valor_sug);
  
              echo "Clave Sugerida: " . $valor_sug;
              echo " ***Palabras encontradas en el diccionario: " . $plaintexts[$valor_sug];
              echo " ***Mensaje Sugerido: " . $found_msg;
              echo "<br>";
            }

        }


  }
?>