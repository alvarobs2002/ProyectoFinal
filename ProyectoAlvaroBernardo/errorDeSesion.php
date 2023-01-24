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
                <h1 class="display-4 fw-bolder">Error al comprar</h1>
                <p class="lead fw-normal text-white-50 mb-0">No tienes una sesión iniciada en la Web, por favor inicie Sesión o Regístrese si no lo está.</p>
            </div>
        </div>
    </header>
<section>
<br>
<br>
<br>
<div style="margin: 0 auto;">
<form method="post">
<input  type="submit" value="Registrarse" name="registrar" class="btn btn-outline-dark mt-auto agregar"  href="" style="margin-left:850px; width:130px;"></input>
</form>
</div>
<br>
<br>
<br>
<form method="post">
<input  type="submit" value="Iniciar Sesion" name="iniciosesion" class="btn btn-outline-dark mt-auto agregar"  href="" style="margin-left:850px; width:130px"></input>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
<p></p>

</section>

   
<!-- Footer-->
<footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p>
            
        </div>
    </footer>
    <?php 
    if(isset($_POST["registrar"])){
        header("Location: registro.php");
    }
    ?>
     <?php 
    if(isset($_POST["iniciosesion"])){
        header("Location: iniciosesion.php");
    }
    ?>    

</body> 


</html>