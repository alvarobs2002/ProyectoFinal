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
if(isset($_POST["eliminar"])){
    $id=$_POST["cont"];
    $query=mysqli_query($conexion,"SELECT * FROM productos WHERE id_categoria='$id'");
    $result=mysqli_num_rows($query);
    if($result>0){
        echo "<div class='alert alert-danger' role='alert'>No se puede eliminar la categoria ya que hay productos que la están usando</div>";
    }
    else{
        $query2=mysqli_query($conexion,"DELETE FROM categorias WHERE id_categoria='$id'");
        if($query){
            echo "<div class='alert alert-success' role='alert'>Se ha eliminado la categoria con exito</div>";

        }else{
            echo "<div class='alert alert-danger' role='alert'>No se pudo eliminar la categoria</div>";

        }
    }
}
?>
  <?php 
  if(isset($_POST["añadir"])){
      header("Location: agregarCategoria.php");
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
      <ul class="navbar-nav ml-auto">
        
        
      </ul>
      <ul class="navbar-nav">
        <a href="administrar.php" class="nav-link text-info" category="all">Productos</a>
        
         
      </ul>
      </ul>
      <ul class="navbar-nav">
        <a href="administrarCategorias.php" class="nav-link text-info" category="all">Categorias</a>
        
         
      </ul>
      <ul class="navbar-nav">
        <a href="administrarVentas.php" class="nav-link text-info" category="all">Ventas</a>
        
         
      </ul>
    
     
    </div>
    
    <ul>
            <?php 
            if(isset($_SESSION["usuario"])){
                $nomusu=$_SESSION["usuario"];
                $query=mysqli_query($conexion,"SELECT nombre, nombreUsuario, tipo FROM usuarios WHERE nombreUsuario='$nomusu'");
                $result=mysqli_num_rows($query);
                if($result>0){
                    $data=mysqli_fetch_assoc($query);
                    echo "Bienvenido ".$data["nombre"].".";
                    echo "<br>";
                    
                    echo "<a href='destruirsesion.php'>Cerrar sesion</a>";
                }
            }else{
            ?>
          <a href="inicioSesion.php" class="btn btn-primary">Iniciar sesión</a>
          <?php } ?>
            </ul>
  </div>
  
</nav>

    </div>
    <!--Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Categorias</h1>
                <p class="lead fw-normal text-white-50 mb-0">Administrar Categorias.</p>
            </div>
        </div>
    </header>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>
                                    <form method="post">
                        <input class="btn btn-warning" value="Añadir" name="añadir" type="submit"></input>
                    </form>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">
                      <?php 
                      $query=mysqli_query($conexion,"SELECT * FROM categorias");
                      $result=mysqli_num_rows($query);
                      if($result>0){
                          while($data=mysqli_fetch_assoc($query)){
                              echo "<tr>";
                              echo "<td>".$data["id_categoria"]."</td>";
                              echo "<td>".$data["categoria"]."</td>";
                              echo "<td>";
                               echo "<form method='post'>";
                                echo "<input type='hidden' name='cont' value='" . $data["id_categoria"] . "'>"; ?>
                                
                                
                               <input type="submit" name="eliminar" value="Eliminar" class="btn btn-outline-dark mt-auto agregar" onclick="confirmarEliminar()"  href="" ></input>
                               <?php
                               echo "</form>";
                               echo "</td>";
                              echo "</tr>";
                          }
                      }
                      ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                

            </div>
        </div>
    </section>
    
   <br>
   <br>
   <br>
   <br>
   <br>

<!-- Footer-->
<footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
            <a href="destruirsesion.php">Destruir sesion</a>
        </div>
    </footer>
    
    

</body> 

</html>