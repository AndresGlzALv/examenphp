<?php

  require 'conexion.php';

  $message = '';

  if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {
    $clavemd5=md5($_POST['clave']);
    $nombre=$_POST['nombre'];
    $usuario=$_POST['usuario'];
    $sql = "INSERT INTO usuarios (nombre, usuario, clave) VALUES ('$nombre', '$usuario', '$clavemd5')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Usuario creado";
   }else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
   }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registrarse</title>
  </head>
  <body>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Regístrate</h1>
    <span>o si ya cuentas con un usuario: <a href="login.php">¡Inicia Sesión!</a></span>

    <form action="registrar.php" method="post">
      <input name="usuario" type="text" placeholder="Ingresa un nombre de usuario">
      <input name="nombre" type="text" placeholder="Ingresa tu nombre">
      <input name="clave" type="password" placeholder="Ingresa una contraseña">
      <input  type="submit" value="Crear cuenta">
    </form>
  </body>
</html>