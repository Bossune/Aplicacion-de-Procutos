<?php
require './config/db.php';
require './funciones.php';
session_start();


if(!empty($_GET['producto']))
{
    $query= "SELECT * FROM producto where nombre like '%".$_GET['producto']."%'";
    if(!empty($_GET['precio']))
    {
        $query= "SELECT * FROM producto where nombre like '%".$_GET['producto']."%' and precio<".$_GET['precio']."";
        
        if(!empty($_GET['Categorias']))
        {
            $query= "SELECT * FROM producto where nombre like '%".$_GET['producto']."%' and precio<".$_GET['precio']." and id_categoria in(".implode(",",$_GET['Categorias']).")";
            echo $query;
        }
    }
    $resultado= $mysqli->query($query);
}
else
{
    header('Location: ./');
    exit();     
}

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Vende Todo - Busqueda</title>
        <!-- Bootstrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="./assets/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="./assets/js/bootstrap.min.js"></script>
        <script src="./assets/js/jquery-3.1.1.min.js"></script>
        <script src="./assets/js/barra_lateral.js"></script>
        <link rel="stylesheet" href="assets/css/simple-sidebar.css">
    </head>
    <body>
        <div class="container">
            <br>
            <header>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1">
                                <span class="sr-only">Menu</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="./index.php" class="navbar-brand">Vende Todo</a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-1">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        Categorias <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php get_categorias_nav();?>
                                    </ul>
                                </li>
                                <li><a href="">Favoritos</a></li>
                            </ul>
                            <?php if(isset($_SESSION['id'])){?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <?php echo $_SESSION['nombre'];?> <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./perfil.php?id=<?php echo $_SESSION['id'];?>">Mi Perfil</a></li>
                                        <li><a href="">Cambiar Contraseña</a></li>
                                        <li><a href="./logout.php">Cerrar Sesión</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php }else{?>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="./login.php" class="text-info"> Iniciar Sesión </a></li>
                                <li><a href="./signup.php" class="text-info"> Registraté </a></li>
                            </ul>
                            <?php }?>
                        </div>
                    </div>
                </nav>
            </header>
        </div>
        <div class="container">
           
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th></th>
                    <th>Producto</th> 
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                    if($resultado->num_rows>0)
                    {
                        while($row = $resultado->fetch_object())
                        {
                         echo "<tr>
                                <td><img id=\"image\"  height=\"500\" width=\"500\" src=\"./get_img_producto.php?id=$row->id\"/></td>
                                <td>$row->nombre</td>
                                <td>$row->id_categoria</td>
                                <td>$row->precio</td>
                                <td><a href=\"./producto.php?id_pd=$row->id\"><button>Link<button></a></td>
                                </tr>";
                        }    
                    }
                    else
                    {?>
                       <div class="alert alert-warning">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Error, No se encontro resultado.</strong>  
                    </div>
                   <?php }
                ?>  
                </tbody>
              </table>
            
        </div>
        
       
    </body>
</html>