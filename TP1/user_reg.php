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
                    $conexion = mysqli_connect($servidorDB, $usuarioDB, $passDB, $basededatos ) or die ("Error en la conexion: <br>" . mysqli_connect_error());
                    
                    $user_pass_hash = password_hash($user_pass, PASSWORD_DEFAULT);
                    
                    $consulta = "INSERT INTO Usersmc (nombre, apynom, pass) VALUES ('" . $user_name . "','" . $user_apynom . "','". $user_pass_hash . "')";
                    $resultado = mysqli_query( $conexion, $consulta ) or die ( "Error al registrar el usuario: <br>" . mysqli_error($conexion));
                    
                    echo "Registro exitoso para el usuario " . $user_name;
                    echo " <a href='user_access.php'>Iniciar Sesion</a>";
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