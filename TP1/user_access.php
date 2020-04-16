<html>
   <head>
   </head>
   <body>
       <h1> HASH - SALT </h1>
       <h2> Autenticación de Usuario </h2>
       <form action="user_access.php" method="POST">
            <br>
            <br>
            Usuario: <input type="text" name="name" style=" width:385px;" placeholder= "Nombre de usuario" required/>
            <br>
            <br>
            Password: <input type="password" name="pass" style="width:385px;" required/>
            <br>
            <br>
          <button type="submit" name="acceder" value="acceder">Entrar</button>
          <br>
          <a href='user_reg.php'>Registrar</a>
        </form>
    </body>
</html>


<?php
    include("acceso_bd.php");

    //Si hizo clic en registrar, doy de alta al usuario
    if (isset($_REQUEST['acceder'])){
        $user_name = $_REQUEST['name'];
        $user_pass = $_REQUEST['pass'];

        //El usuario no puede ser solo espacios
        if (!empty(trim($user_name))){
            //La contraseña no puede ser solo espacios
            if (!empty(trim($user_pass))){
                $conexion = new mysqli($servidorDB, $usuarioDB, $passDB, $basededatos);

                /* comprobar la conexión */
                if ($conexion->connect_errno) {
                    printf("Falló la conexión: %s\n", $conexion->connect_error);
                    exit();
                }
                
                $consulta = "SELECT apynom, pass FROM Usersmc where nombre = '" . $user_name . "'";
                $resultado = $conexion->query($consulta);
                    
                //Si el usuario existe valido la contraseña, sino pido que se registre
                //Nombre de usuario es clave unica en la base por lo que a lo sumo solo devuelve una fila la consulta.
                if ($row = $resultado->fetch_assoc()){
                    //Valido contraseña
                    if (password_verify($user_pass, $row["pass"] )){
                        echo "Bienvenido ".  $row["apynom"] . "<br>";
                    }else{
                        echo "Contraseña incorrecta. <br>";
                    };
                }else{
                    //sino muestro mensaje para que registre
                    echo "No existe el usuario, por favor Registrar. <br>";
                }
                
                // liberar el conjunto de resultados
                $resultado->close();
                // liberar la conexion
                $conexion->close();
            }else{
                echo "Debe escribir una contraseña. <br>"; 
            }
        }else{
            echo "Debe escribir un nombre de usuario. <br>";
        }
    }
?>