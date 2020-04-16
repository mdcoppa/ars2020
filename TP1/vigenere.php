<?php
      function mod($a, $n) {
        return ($a % $n) + ($a < 0 ? $n : 0);
      }
      
      class Vigenere {
        //Alfabeto a utilizar por la clase (solo se cifran los caracteres del alfabeto)
        private $alfabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");


        //Funcion para validar el mensaje de entrada
        public function validar_mensaje($mensaje){
          if (empty($mensaje)){
            echo "Debe escribir un mensaje. <br>";
            return false;
          }
          
          return true;
        }

        //Funcion para validar la clave que se utiliza para cifrar
        public function validar_clave($clave){
          if (empty($clave)){
            echo "Debe escribir una clave. <br>";
            return false;
          }
          return true;
        }
        
        //Funcion para cifrar el mensaje segun la clave dada
        public function cifrar($mensaje, $clave){
            $tamano_mensaje =  strlen($mensaje);
            $tamano_clave = strlen($clave);
            
            $pos_clave=0;
            $resultado = ''; 

            for ($pos_txt=0; $pos_txt < $tamano_mensaje; $pos_txt++) {              
                //Empiezo por el primer caracter de la clave si ya utilice todos.
                if ($pos_clave == $tamano_clave){
                  $pos_clave = 0;
                }

                //Busco la posicion para cada uno de los caracteres de la clave
                //La posicion encontrada es el dezplazamiento que uso para cifrar
                for ($i=0; $i < 27; $i++) {
                  if (ord($clave[$pos_clave]) == ord($this->alfabeto[$i])) {
                    $orden_clave = $i;
                    break;
                  }
                }
                
                //Busco la posicion de cada caracter del mensaje y lo cifro con el dezplazamiento encontrado
                for ($j=0; $j < 27; $j++) {
                  if (strcmp($mensaje[$pos_txt], ' ') == 0){                      //los espacios quedan igual
                    $resultado .= ' ';
                  }else{
                    if (ord($mensaje[$pos_txt]) == ord($this->alfabeto[$j])) {
                      $resultado .= $this->alfabeto[($j+$orden_clave)%27];
                    }
                  }
                }
                
                //Paso al siguiente caracter de la clave
                $pos_clave++;
                //Si la Ñ es parte de la clave tengo que avanzar un caracter mas 
                if (ord($clave[$pos_clave]) == ord("Ñ")){
                  $pos_clave++;
                }
                
            }
            
            return $resultado;
          }


        //Funcion para descifrar el mensaje segun el desplazamiento dado
        public function descifrar($mensaje, $clave){
          $tamano_mensaje =  strlen($mensaje);
          $tamano_clave = strlen($clave);
          $pos_clave=0;
          $resultado = '';

          for ($pos_txt=0; $pos_txt < $tamano_mensaje; $pos_txt++) {
              //Los espacios en blanco no se modifican.
              //Se asume que el mensaje solo contiene caracteres del alfabeto, se verifica el mensaje antes.
              
              
              //Empiezo por el primer caracter de la clave si ya utilice todos.
              if ($pos_clave == $tamano_clave){
                $pos_clave = 0;
              }

              //Busco la posicion para cada uno de los caracteres de la clave
              for ($i=0; $i < 27; $i++) {
                if (ord($clave[$pos_clave]) == ord($this->alfabeto[$i])) {
                  $orden_clave = $i;
                  break;
                }
              }

              for ($i=0; $i < 27; $i++) {
                if (strcmp($mensaje[$pos_txt], ' ') == 0){
                  $resultado .= ' ';
                }else{
                  if (ord($mensaje[$pos_txt]) == ord($this->alfabeto[$i])) {
                    $resultado .= $this->alfabeto[mod($i-$orden_clave,27)];
                  }
                }
              }
              //Paso al siguiente caracter de la clave
              $pos_clave++;
            
          }
          return $resultado;
        }


      }
?>