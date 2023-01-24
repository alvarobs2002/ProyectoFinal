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
</head>
 <body>
 <?php
    if (isset($_POST["agregar"])){
        $id=$_POST["product_id"];
        $precio=$_POST["product_price"];
        array_push($_SESSION["carrito"],$id);
        $_SESSION["contadorCarrito"]++;
        $_SESSION["precioTotal"]=$_SESSION["precioTotal"]+$precio;
        
      
    }
?>


   
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
                <h1 class="display-4 fw-bolder">Iniciar Sesión</h1>
                <p class="lead fw-normal text-white-50 mb-0">¡Disfruta la experiencia!</p>
            </div>
        </div>
    </header>
    <section>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">
        <form action="" method="post">
          <div class="form-group">
            <label for="nombre_usuario">Nombre de usuario:</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
          </div>
          <br>
          <br>
          <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
          </div>
<br>
<br>
          <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  
  
</section>
<?php 
if(isset($_POST["enviar"])){
    $usuario=$_POST["nombre_usuario"];
    $contra=$_POST["contrasena"];
    $query=mysqli_query($conexion,"SELECT nombreUsuario,contra FROM usuarios WHERE nombreUsuario='$usuario' AND contra='$contra'");
    $result=mysqli_num_rows($query);
    if($result>0){
        echo "<div class='alert alert-success' role='alert'>Has iniciado sesion con exito</div>";
       echo "<div style='margin-left:850px;'>";
       echo "<a href='index.php'>Ir a comprar</a>";
       echo "</div>";
       $_SESSION["usuario"]=$usuario;
       $_SESSION["precioTotal"]=0;
       $_SESSION["contadorCarrito"]=0;
       array_splice($_SESSION["carrito"],0,count($_SESSION["carrito"]));

    }else {
        echo "<div class='alert alert-danger' role='alert'>";
        echo "Nombre de usuario o contraseña incorrecto";
        echo "</div>";
    }
}
?>
<p>¿No tienes cuenta?<a href="registro.php">Registrate</a></p>

   
<!-- Footer-->
<footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
            
        </div>
    </footer>
    
    

</body> 

</html>