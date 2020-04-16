# ARQUITECTURA DE REDES Y SERVICIOS
# TRABAJO PRACTICO N° 1


## Criptografía Simétrica
### Cifrador/Descifrador Caesar
Se implementa el programa mediante 3 archivos
- caesar.php: Contiene las funciones para cifrar/descifrar, alfabeto a utilizar y validaciones para el mensaje y clave de entrada.
  - $alfabeto[]: Arreglo con el alfabeto permitido.
  - $validar_mensaje() / $validar_clave(): Validación del mensaje y la clave del usuario. 
  - cifrar($mensaje, $key): Encripta el mensaje desplazandolo $key posiciones. 
  - descifrar($mensaje, $key): Desencripta el mensaje segun $key posiciones. 
  - crackfb($mensaje): Función de fuerza bruta para desecriptar el mensaje. 
    La función desencripta el mensaje usando todas las claves posibles y busca las palabras del mensaje desencriptado en diccionario.txt. La clave que tenga más palabras encontradas las devolverá como resultado de la función junto con el mensaje descrifado para esa clave. 
La función puede devolver más de 1 clave y mensaje descifrado.

   Consideraciones: los espacios en blanco no se encriptan/desencriptan.


- test_caesar.php: Interfaz de usuario.

   El formulario valida mediante HTML:
   - Clave: Se verifica que el campo no este vacío y que sea número entero.
   - Mensaje: Se verifica que el campo no este vacío y que se escriba como máximo 254 caracteres.

- diccionario.txt: Diccionario utilizado por la función de fuerza bruta

### Cifrador/Descifrador Vigenere
Se implementa el programa mediante 2 archivos
- vigenere.php: Contiene las funciones para cifrar/descifrar, alfabeto a utilizar y validaciones para el mensaje y clave de entrada.
  - $alfabeto[]: Arreglo con el alfabeto permitido.
  - $validar_mensaje() / $validar_clave(): Validación del mensaje y la clave del usuario. 
  - cifrar($mensaje, $key): Encripta el mensaje utilizando $key. 
  - descifrar($mensaje, $key): Desencripta el mensaje utilizando $key. 
  
   Consideraciones: los espacios en blanco no se encriptan/desencriptan.


- test_vigenere.php: Interfaz de usuario.

   El formulario valida mediante HTML:
   - Clave: Se verifica que el campo no este vacío y que se escriba como máximo 254 caracteres.
   - Mensaje: Se verifica que el campo no este vacío y que se escriba como máximo 254 caracteres.


## Hash
Los hash o funciones de resumen son algoritmos que consiguen crear a partir de una entrada (ya sea un texto, una contraseña o un archivo, por ejemplo) una salida alfanumérica de longitud normalmente fija que representa un resumen de toda la información que se le ha dado (es decir, a partir de los datos de la entrada crea una cadena que solo puede volverse a crear con esos mismos datos).
1.	No se utilizan para cifrar mensajes ya que estos algoritmos aseguran que con la respuesta (o hash) nunca se podrá saber cuáles han sido los datos insertados, lo que indica que es una función unidireccional.
2.	
    a)	Para la autenticación de usuarios, lo más común es hacerlo mediante un usuario y una contraseña.  Esa contraseña no debe ser almacenada en texto plano para evitar malos usos internos o externos.  Los algoritmos hash sirven para obtener una cadena ilegible y dicha cadena es lo que almacenamos. Cuando el usuario intenta loguearse se verifica que la contraseña coincide calculando el hash de la contraseña introducida y comparándola con la guardada.

    b) En la descarga de archivos, se suele poner el hash del archivo para compararlo con el hash del archivo descargado, si ambos coinciden significa que se tiene el mismo archivo, en caso contrario significa que ocurrió algún problema en la descarga y el archivo es corrupto.

3.	Salt es un concepto que generalmente está asociado al hashing de contraseñas. Es un valor que se agrega a  la contraseña para crear un valor hash diferente. Esto agrega una capa de seguridad al proceso de hash, específicamente contra ataques de fuerza bruta que utilizan Rainbow Tables, estas son tablas de búsqueda inversa para hashes. El creador de las tablas precalcula los hashes para palabras comunes, frases, palabras modificadas y strings aleatorios.

 ### Programa de Registro/Autenticación utilizand Hash - Salt
 Se implementa el programa mediante 3 archivos:
 - acceso_bd.php: Tiene las variables que se usan para establecer la conexión a la base de datos.
 - user_reg.php: Da de alta al usuario en la base de datos.

    El formulario valida mediante HTML:
   - Usuario: Se verifica que el campo no este vacío.
   - Nombre y Apellido: Se verifica que el campo no este vacío. 
   - Password: Se verifica que el campo no este vacío.
   
   Para almacenar el hash se utiliza la función password_hash(password_plano, PASSWORD_DEFAULT) que devuelve el hash de la contraseña. El algoritmo, coste y salt usados son devueltos como parte del hash. Por lo tanto, toda la información que es necesaria para verificar el hash, está incluida en él. Constante PASSWORD_DEFAULT: Usa el algoritmo bcrypt (predeterminado a partir de PHP 5.5.0). 
- user_access.php: Se utiliza para la autenticación del usuario.
    
    El formulario valida mediante HTML:
   - Usuario: Se verifica que el campo no este vacío.
   - Password: Se verifica que el campo no este vacío.
   
   Para la verificacion de password se utiliza la función password_verify(password_plano, hash) Hay que observar que password_hash() devuelve el algoritmo, el coste y el salt como parte del hash devuelto. Por lo tanto, toda la información que es necesaria para verificar el hash está incluida. Esto permite a la función de verificación comprobar el hash sin la necesidad de almacenar por separado la información del salt o del algoritmo.

Se incluye también el archivo usersmc.sql para la creación de la tabla de usuarios correspondientes.
