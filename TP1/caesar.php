<?php
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
                    $resultado .= $this->alfabeto[($i-$desplazamiento)%27];
                  }
                }
              }
          }
          return $resultado;
        }
  }
?>