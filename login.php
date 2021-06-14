<?php

  session_start();

  if (isset($_SESSION['usuario'])) {

    header('Location: /index.php');
  }
  require 'conexion.php';

  if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {


    $clavemd5=md5($_POST['clave']);
    $usuario=$_POST['usuario'];
    $sql = "SELECT id_usuario, usuario, clave FROM usuarios WHERE usuario = '$usuario' AND clave = '$clavemd5'";
    
    
        $result=mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0)  {  
            $rows=mysqli_fetch_array($result);
            $_SESSION['id'] = $rows[0]; 
            $sqlhistorial = "INSERT INTO historial (usuario, clave, entro) VALUES ('$usuario', '$clavemd5', '7')";
            mysqli_query($conn, $sqlhistorial);
    
             header("location: index.php");  
        }  
        else  
        {  
            echo '<script>alert("Datos incorrectos")</script>';  
        }  
    

  }

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesión</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="asserts/css/style.css">
  </head>
  <body>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Inicio de Sesión</h1>
    <span> Si aún no cuentas con un usuario: <a href="registrar.php">¡Registrate!</a></span>

    <form action="login.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingresa tu nombre de usuario">
      <input name="clave" type="password" placeholder="Ingresa tu contraseña">
      <input type="submit" value="Iniciar sesión">
    </form>
  </body>
</html>