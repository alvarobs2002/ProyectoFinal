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
                <h1 class="display-4 fw-bolder">Añadir Categorias</h1>
               <p class="lead fw-normal text-white-50 mb-0">Añade una categoría.</p>
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
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
          </div>

         
        
          <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
        </form>
      </div>
    </div>
  </div>
  <p><a href="administrar.php">Volver al menu de Administrador</a></p>
</section>
<?php 
     if(isset($_POST["enviar"])){
         $nombre=$_POST["nombre"];
         $query=mysqli_query($conexion,"SELECT * FROM categorias WHERE categoria='$nombre'");
         $result=mysqli_num_rows($query);
         if($result>0){
            echo "<div class='alert alert-danger' role='alert'>Esa categoria ya existe, introduzca otra.</div>";

         }
         else{
             $query2=mysqli_query($conexion,"INSERT INTO categorias (id_categoria,categoria) VALUES (NULL,'$nombre')");
             if($query){
                echo "<div class='alert alert-success' role='alert'>La categoria se ha registrado con exito</div>"; 

             }else{
                echo "<div class='alert alert-danger' role='alert'>No se pudo insertar la categoria</div>";

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