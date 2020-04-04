<?php
  function mod($a, $n) {
    return ($a % $n) + ($a < 0 ? $n : 0);
  }
  class Caesar {
        //Alfabeto a utilizar por la clase (solo se cifran los caracteres del alfabeto)
        private $alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

        //Funcion para cifrar el mensaje segun el desplazamiento dado
        public function encriptar($mensaje, $desplazamiento){
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
                      $resultado .= $this->alfabeto[($i+$desplazamiento)%27];
                    }
                  }
                }
              
            }
            return $resultado;
          }


        //Funcion para descifrar el mensaje segun el desplazamiento dado
        public function desencriptar($mensaje, $desplazamiento){
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
                  $resultado .= $this->alfabeto[mod($i-$desplazamiento,27)];
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
                $nro_ocurrencias = substr_count($msg_aux, $palabra_dicc);
                echo "** Mensaje aux: " . $msg_aux;
                echo "** Palabra dicc: " . $palabra_dicc;
                //echo "** Len pal dicc: " . strlen(trim($palabra_dicc));
                echo "<br>";

                if ($nro_ocurrencias > $nro_ocurrencia_max){
                  $nro_ocurrencia_max = $nro_ocurrencias;
                }
              }
              fclose($fp);
              echo "Nro de ocurrencias maximas: " . $nro_ocurrencia_max;
              echo "<br>";
              echo "<br>";
              //Asigno el maximo nro de ocurrencias para la $key
              $plaintexts[$key] = $nro_ocurrencia_max;
            }
    
           
           
            /*
            
            foreach (range(0, 26) as $key){
              echo "<br>";
              echo "Key: " . $plaintexts[$key];
              echo "<br>";
              echo "Text: " . strtoupper($this->desencriptar($mensaje, $key));
              echo "<br>";
            }

            */


            //Encuentro la clave que tiene mas apariciones
            //array_keys ( array $input [, mixed $search_value = NULL [, bool $strict = false ]] )
            $sugerencias = array_keys($plaintexts,max($plaintexts));

            foreach ($sugerencias as $valor_sug) {
              
              //$found_key = array_search(max($plaintexts), $plaintexts);
              $found_msg =  $this->desencriptar($mensaje, $valor_sug);
  
              echo "Clave Sugerida: " . $valor_sug;
              echo " * Mensaje Sugerido: " . $found_msg;
              echo "<br>";


            }

        }


  }
?>