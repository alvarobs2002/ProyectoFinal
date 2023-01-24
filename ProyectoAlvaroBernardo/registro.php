<?php  require_once "conexion.php";
session_start();
if(!isset($_SESSION["precioTotal"])){
    $_SESSION["precioTotal"]=0;
}
if(!isset($_SESSION["contadorCarrito"])){
    $_SESSION["contadorCarrito"]=0;
}
if(!isset($_SESSION["carrito"])){
$carritoArray=array();
$_SESSION["carrito"]=$carritoArray;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/estilos.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
 <body>
 


   
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">AMVintage</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Registrarse</h1>
               <p class="lead fw-normal text-white-50 mb-0">¡Regístrese para una mejor experiencia!.</p>
            </div>
        </div>
    </header>
<section>
<br>
<br>
<div style="margin-left:300px;">
<form method="post">
<section>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <form action="procesa_formulario.php" method="post">
          <div class="form-group">
            <label for="nombre_usuario">Nombre de usuario:</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
          </div>
          <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
          </div>
          <div class="form-group">
            <label for="nombre_completo">Nombre completo:</label>
            <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
          </div>
          <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
          </div>
          <div class="form-group">
            <label for="gmail">Gmail:</label>
            <input type="email" class="form-control" id="gmail" name="gmail" pattern="[a-z0-9._%+-]+@gmail.com" title="Por favor ingrese una dirección de correo electrónico válida en el formato de Gmail (ejemplo: usuario@gmail.com)" required>

          </div>
          <div class="form-group">
            <label for="numero_telefono">Número de teléfono:</label>
            <input type="tel" class="form-control" id="numero_telefono" name="numero_telefono" required>
          </div>
          <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
  <p>¿Ya tienes cuenta?<a href="inicioSesion.php">Inicia sesión</a></p>
</section>
<?php 
     if(isset($_POST["enviar"])){
         $usuario=$_POST["nombre_usuario"];
         $contra=$_POST["contrasena"];
         $nombre=$_POST["nombre_completo"];
         $direccion=$_POST["direccion"];
         $email=$_POST["gmail"];
         $tel=$_POST["numero_telefono"];
         $query=mysqli_query($conexion,"SELECT nombreUsuario,gmail FROM usuarios where nombreUsuario='$usuario' OR gmail='$email'");
         $result=mysqli_num_rows($query);
         if($result>0){
             echo "<div class='alert alert-danger' role='alert'>";
             echo "Nombre de usuario o gmail ya está registrado en la base de datos";
             echo "</div>";
         }
         else{
             $query=mysqli_query($conexion,"INSERT INTO usuarios (nombre,nombreUsuario,contra,direccion,gmail,telefono,tipo) VALUES ('$nombre','$usuario','$contra','$direccion','$email','$tel','usuario')");
             if ($query) {
                
                echo "<div class='alert alert-success' role='alert'>El registro se ha realizado con éxito</div>";
            } else {
                
                echo "<div class='alert alert-danger' role='alert'>No se han podido insertar los datos</div>";
            }
         }
     }
     ?>

</form>
</div>
<br>
<div style="margin: 0 auto;">


<p></p>

</section>

   
<!-- Footer-->
<footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
            
        </div>
    </footer>
     

</body> 


</html>