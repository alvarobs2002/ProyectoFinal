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
 <script>
    function confirmarEliminar() {
      if (confirm('¿Seguro que deseas eliminar este producto?')) {
        // Código PHP que elimina el producto
        <?php
        if(isset($_POST["eliminar"])){
          $id = $_POST["cont"]; // ID del producto a eliminar (suponiendo que es 1)
          $query=mysqli_query($conexion,"DELETE  FROM productos WHERE id='$id'");
          if($query){
            echo "<div class='alert alert-success' role='alert'>Se ha eliminado el producto con exito</div>";
          }
          else{
            echo "<div class='alert alert-danger' role='alert'>No se pudo eliminar el producto</div>";
          }
        }
        ?>
      }
    }
  </script>
  <?php 
  if(isset($_POST["añadir"])){
      header("Location: addProducts.php");
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
                <h1 class="display-4 fw-bolder">Productos</h1>
                <p class="lead fw-normal text-white-50 mb-0">Administrar Productos.</p>
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
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Categoria</th>
                                    <th>
                                    <form method="post">
                        <input class="btn btn-warning" value="Añadir" name="añadir" type="submit"></input>
                    </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">
                       <?php 
                       $query=mysqli_query($conexion,"SELECT *
                       FROM productos
                       INNER JOIN categorias
                       ON productos.id_categoria = categorias.id_categoria");
                       $result=mysqli_num_rows($query);
                       if($result>0){
                           while($data=mysqli_fetch_assoc($query)){
                               echo "<tr>";
                               ?>
                               <td>
                               <img class="card-img-top img-size" src="img/<?php echo $data['imagen']; ?>" alt="..." style="width:50px; height:auto; margin:auto" />  
                               </td>
                               <?php
                               echo "<td>".$data["nombre"]."</td>";
                               echo "<td>".$data["descripcion"]."</td>";
                               echo "<td>".$data["precio"]."</td>";
                               echo "<td>".$data["cantidad"]."</td>";
                               echo "<td>".$data["categoria"]."</td>";
                               echo "<td>";
                               echo "<form method='post'>";
                                echo "<input type='hidden' name='cont' value='" . $data["id"] . "'>"; ?>
                                
                                
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
           
        </div>
    </footer>
    
    

</body> 

</html>