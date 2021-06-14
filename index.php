<?php
  session_start();

  require 'conexion.php';

  if (isset($_SESSION['id'])) {
    $user = $_SESSION['id'];

  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
  </head>
  <body>

    <?php if(!empty($user)): ?>
      <br> ¡Bienvenido
      <br>Has iniciado sesión con éxito!!

 
      <?php
$sql="SELECT empresas.*, ciudades.nombrecd, ciudades.cp FROM empresas JOIN ciudades ON empresas.ciudad = ciudades.id_ciudad WHERE empresas.asignado='$user'";
$sqlresult= mysqli_query($conn,$sql);
$registro= mysqli_fetch_array($sqlresult);
echo "<table border>";
echo
"
<tr>
<td>ID empresa</td>
<td>Nombre de empres</td>
<td>Ciudad</td>
<td>Contacto</td>
<td>CP</td>
</tr>";
do{
    $id= $registro['id_empresa'];
    $nombre= $registro['nombre'];
    $contacto= $registro['contacto'];
    $cd= $registro['nombrecd'];
    $cp=$registro['cp'];
    echo
     "
     <tr>
     <td>$id</td>
     <td>$nombre</td>
     <td>$cd</td>
     <td>$contacto</td>
     <td>$cp</td>
     </tr>";
}while($registro=mysqli_fetch_array($sqlresult));
echo"</table>";
?>


      <a href="logout.php">Cerrar sesión</a>
      <br>       

    <?php else: ?>
      <h1>Por favor Inicia Sesión o Registrate </h1>

      <a href="login.php">Iniciar Sesión </a> o
      <a href="registrar.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>