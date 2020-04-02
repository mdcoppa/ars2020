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

        public function crack($mensaje){
            $plaintexts = [];
            $crack = "";

            foreach (range(0, 26) as $key) {
                $plaintexts[$key] = substr_count(strtoupper($this->desencriptar($mensaje, $key)), 'A');
                //echo $plaintexts[$key];
                echo "<br>";
            }
    
            //Encuentro la clave donde 'A' tiene mas apariciones
            $found_key = array_search(max($plaintexts), $plaintexts);
            $found_msg = $this->desencriptar($mensaje, $found_key);

            //Guardo el resultado en el archivo
            $file = fopen("crack.txt", "w");
            
            fwrite($file, "****Sugerencia de clave: ". $found_msg);
            fclose($file);
        }


  }
?>