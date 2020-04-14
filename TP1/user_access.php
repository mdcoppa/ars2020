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

        //El usuario no puede estar en blanco
        if (!empty(trim($user_name))){
            //La contraseña no puede estar en blanco
            if (!empty($user_pass)){
                $conexion = mysqli_connect($servidorDB, $usuarioDB, $passDB, $basededatos ) or die ("Error en la conexion: <br>" . mysqli_connect_error());
                //$db = mysqli_select_db( $conexion, $basededatos ) or die ("No se pudo conectar a la base de datos: " . $basededatos . "<br>");
    
                $consulta = "SELECT apynom, pass FROM Usersmc where nombre = '" . $user_name . "'";
                $resultado = mysqli_query( $conexion, $consulta ) or die ( "Error al autenticar: <br>" . mysqli_error($conexion));
                
                //Si el usuario existe valido la contraseña, sino pido que se registre
                //Nombre de usuario es clave unica en la base por lo que a lo sumo solo devuelve una fila la consulta.
                if ($row = $resultado->fetch_assoc()){
                    //Valido contraseña
                    if (password_verify($user_pass, $row["pass"] )){
                        echo "Bienvenido ".  $row["apynom"] . "<br>";
                    }else{
                        echo "Contraseña incorrecta. <br>";
                    };
                    $resultado->free();
                }else{
                    //sino muestro mensaje para que registre
                    echo "No existe el usuario, por favor Registrar. <br>";
                }


                
                



                mysqli_close( $conexion );
            }else{
                echo "Debe escribir una contraseña. <br>"; 
            }
        }else{
            echo "Debe escribir un nombre de usuario. <br>";
        }
    }
?>