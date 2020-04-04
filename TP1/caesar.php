<?php
  function mod($a, $n) {
    return ($a % $n) + ($a < 0 ? $n : 0);
  }
  class Caesar {
        //Alfabeto a utilizar por la clase (solo se cifran los caracteres del alfabeto)
        private $alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

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


            //For para probar con todas las claves (o desplazamientos posibles)
            foreach (range(0, 26) as $key) {
              $msg_aux = strtoupper($this->desencriptar($mensaje, $key));
              $nro_ocurrencia_max=0;
              
              $fp = fopen("diccionario.txt", "r");
              //Recorro cada palabra del diccionario y me fijo cuantas veces aparece en la palabra desencriptada
              while (!feof($fp)){
                $palabra_dicc = strtoupper(trim(fgets($fp)));
                if (!empty($palabra_dicc)){
                    $nro_ocurrencias = substr_count($msg_aux, $palabra_dicc);
                  /* Pruebas de control
                  echo "** Mensaje aux: " . $msg_aux;
                  echo "** Palabra dicc: " . $palabra_dicc;
                  echo "** Len pal dicc: " . strlen(trim($palabra_dicc));
                  echo "<br>";
                  */
                  if ($nro_ocurrencias > $nro_ocurrencia_max){
                    $nro_ocurrencia_max = $nro_ocurrencias;
                  }
                }
              }
              fclose($fp);
              /* Pruebas de control
              echo "Nro de ocurrencias maximas: " . $nro_ocurrencia_max;
              echo "<br>";
              echo "<br>";
              */
              //Asigno el maximo nro de ocurrencias para la $key
              $plaintexts[$key] = $nro_ocurrencia_max;
            }

            //Encuentro la clave que tiene mas apariciones
            // Si mas de una clave tiene la misma cantidad de apariciones maxima, queda guardada en $sugerencias
            $sugerencias = array_keys($plaintexts,max($plaintexts));

            // Imprimo todas las sugerencias encontradas
            foreach ($sugerencias as $valor_sug) {
              $found_msg =  $this->desencriptar($mensaje, $valor_sug);
  
              echo "Clave Sugerida: " . $valor_sug;
              echo " * Mensaje Sugerido: " . $found_msg;
              echo "<br>";
            }

        }


  }
?>