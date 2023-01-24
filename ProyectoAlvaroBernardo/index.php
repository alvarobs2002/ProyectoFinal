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

<a href="carrito.php" class="btn-flotante" id="btnCarrito">Carrito <span class="badge bg-success" id="carrito"><?php 
echo $_SESSION["contadorCarrito"];


?></span></a>
   
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AMVintage</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        
        
      </ul>
      <ul class="navbar-nav">
        <a href="index.php" class="nav-link text-info" category="all">Todo</a>
        <?php
          $query = mysqli_query($conexion, "SELECT * FROM categorias");
          while ($data = mysqli_fetch_assoc($query)) { ?>
            <a href="mostrarCategoria.php?nombre=<?php echo $data["categoria"]; ?>" class="nav-link" category="<?php echo $data['categoria']; ?>"><?php echo $data['categoria']; ?></a>
          <?php } ?>
         
      </ul>
      <?php 
      if(isset($_SESSION["usuario"])){
?>
 <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <a href="verCompras.php" class="nav-link text-info">Ver Compras</a>
            </ul>

    </div>
    <?php
      }
      ?>
     
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
                    if($data["tipo"]=="administrador"){
                        echo "<a href='administrar.php'>Administrar</a>";
                        echo "<br>";
                    }
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
                <h1 class="display-4 fw-bolder">AMVintage</h1>
                <p class="lead fw-normal text-white-50 mb-0">Old vibes.</p>
            </div>
        </div>
    </header>
    <section class="py-5">
    <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
    $query = mysqli_query($conexion, "SELECT p.*, c.id_categoria AS id_cat, c.categoria FROM productos p INNER JOIN categorias c ON c.id_categoria = p.id_categoria");
    $result=mysqli_num_rows($query);
    if ($result > 0) {
        while ($data = mysqli_fetch_assoc($query)) { ?>
            <div class="col mb-5 productos" category="<?php echo $data['categoria']; ?>">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem"><?php echo ($data['precio'] )  ?></div>
                    <!-- Product image-->
                    <img class="card-img-top img-size" src="img/<?php echo $data['imagen']; ?>" alt="..." style="width:270px; height:300px; margin:auto" />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $data['nombre'] ?></h5>
                            <p><?php echo $data['descripcion']; ?></p>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <!-- <span class="text-muted text-decoration-line-through"><?php echo $data['precio'] ?></span> -->
                           
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <form method="post">
                            
                        <div class="text-center">
                            <?php echo "<input type='hidden' name='product_id' value='" . $data['id'] . "'>";?>
                            <?php echo "<input type='hidden' name='product_price' value='" . $data['precio'] . "'>";?>
                            <input type="submit" value="Agregar" name="agregar" class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['id']; ?>" href="" ></input>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php  }
    } ?>
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