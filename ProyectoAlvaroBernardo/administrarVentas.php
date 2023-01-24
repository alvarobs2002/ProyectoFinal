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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Carrito de Compras</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> -->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/estilos.css" rel="stylesheet" />
</head>
<?php 
        if (isset($_POST["eliminar"])){
           $id=$_POST["cont"];
           $precio=$_POST["precio"];
          $eliminar=array($id);
    
          $_SESSION["carrito"]=array_diff($_SESSION["carrito"],$eliminar);
          
           $_SESSION["contadorCarrito"]--;
           $_SESSION["precioTotal"]=$_SESSION["precioTotal"]-$precio;

        }

    ?>
    <?php 
    if(isset($_POST["vaciarCarrito"])){
        array_splice($_SESSION["carrito"],0,count($_SESSION["carrito"]));
        $_SESSION["precioTotal"]=0;
        $_SESSION["contadorCarrito"]=0;
    }
    ?>
    <?php 
    if(isset($_POST["comprar"])){
        if(!isset($_SESSION["usuario"])){
            header("Location: errorDeSesion.php");
        }else{
            $comp=false;
            $fecha=date("d-m-Y");
            $usuario=$_SESSION["usuario"];
            foreach($_SESSION["carrito"] as $value){
                $query=mysqli_query($conexion,"INSERT INTO compras (idCompra,id_producto,nombreUsuario,fecha) VALUES (NULL,'$value','$usuario','$fecha')");
                if ($query) {
                
                    $comp=true;
                    array_splice($_SESSION["carrito"],0,count($_SESSION["carrito"]));
        $_SESSION["precioTotal"]=0;
        $_SESSION["contadorCarrito"]=0;

                } else {
                    
                    echo "<div class='alert alert-danger' role='alert'>No se ha realizar la compra</div>";
                }
            }
            echo "<div class='alert alert-success' role='alert'>La compra se ha realizado con exito</div>";

           
        }
    }
    ?>
<body>

    <!-- Navigation-->
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
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Ventas</h1>
                <p class="lead fw-normal text-white-50 mb-0">Todas las compras de los clientes.</p>
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
                                    <th>ID compra</th>
                                    <th>ID producto</th>
                                    <th>Usuario</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Fecha</th>
                                </tr>
                            </thead>
                            <tbody id="tblCarrito">
                        <?php 
                        $nomUsu=$_SESSION["usuario"];
                        $query=mysqli_query($conexion,"SELECT *
                        FROM compras
                        INNER JOIN productos
                        ON compras.id_producto = productos.id;");
                        $result=mysqli_num_rows($query);
                        if($result>0){

                           while($data=mysqli_fetch_assoc($query)){
                               echo "<tr>";
                               echo "<td>".$data["idCompra"]."</td>";
                               echo "<td>".$data["id_producto"]."</td>";
                               echo "<td>".$data["nombreUsuario"]."</td>";
                               echo "<td>".$data["nombre"]."</td>";
                               echo "<td>".$data["precio"]."</td>";
                               echo "<td>1</td>";
                               echo "<td>".$data["fecha"]."</td>";
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
    
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
        </div>
    </footer>
  
    
</body>

</html>