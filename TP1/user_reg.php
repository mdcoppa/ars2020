<html>
   <head>
   </head>
   <body>
       <h1> HASH - SALT </h1>
       <h2> Alta de Usuario </h2>
       <form action="user_reg.php" method="POST">
            <br>
            <br>
            Usuario: <input type="text" name="name" style=" width:385px;" placeholder="Nombre de usuario" required/>
            <br>
            <br>
            Nombre y Apellido: <input type="text" name="apynom" style=" width:385px;" required/>
            <br>
            <br>
            Password: <input type="password" name="pass" style="width:385px;" required/>
            <br>
            <br>
          <button type="submit" name="registrar" value="Registrar">Registrar</button>
        </form>
    </body>
</html>


<?php
    include("acceso_bd.php");

    //Si hizo clic en registrar, doy de alta al usuario
    if (isset($_REQUEST['registrar'])){
        $user_name = $_REQUEST['name'];
        $user_pass = $_REQUEST['pass'];
        $user_apynom = $_REQUEST['apynom'];

        //Prevengo los espacios en blanco
        if (!empty(trim($user_name))){
            //Prevengo los espacios en blanco
            if (!empty(trim($user_apynom))){
                //Prevengo los espacios en blanco
                if (!empty($user_pass)){
                    //Establezco conexion con la base de datos
                    $conexion = new mysqli($servidorDB, $usuarioDB, $passDB, $basededatos);

                    /* comprobar la conexión */
                    if ($conexion->connect_errno) {
                        echo "Falló la conexión: " . $conexion->connect_error;
                        exit();
                    }
                
                    $user_pass_hash = password_hash($user_pass, PASSWORD_DEFAULT);
                    
                    $consulta = "INSERT INTO Usersmc (nombre, apynom, pass) VALUES ('" . $user_name . "','" . $user_apynom . "','". $user_pass_hash . "')";

                    // Ejecuto el INSERT 
                    if ($conexion->query($consulta)){             
                        echo "Registro exitoso para el usuario " . $user_name;
                        echo " <a href='user_access.php'>Iniciar Sesion</a>";
                    }else{
                        echo "Fallo al agregar el usuario: " . $conexion->error;
                    }

                    // liberar la conexion
                    $conexion->close();
                }else{
                    echo "Debe escribir una contraseña. <br>";
                }
            }else{
                echo "Debe escribir un Nombre y Apellido. <br>"; 
            }
        }else{
            echo "Debe escribir un nombre de usuario. <br>";
        }
    }
?>