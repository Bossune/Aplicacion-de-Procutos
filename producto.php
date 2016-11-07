<?php

require './config/db.php';
require './funciones.php';
session_start();


if(!empty($_GET['id']))
{
    $query= "SELECT * from producto where id =".$_GET['id'];
    
    $resultado= $mysqli->query($query);
        
}
else
{
    $query = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vende Todo</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style>
		#TablaVendedor{
			text-align: center;
			border: 1px solid #D4D4D4;
			background-color: #F4F4F4;
		}
		#a_VU{
			color: white;
			text-decoration: none;
		}
		#a_VU:hover{
			color:white;
		}
	</style>
</head>
<body>
	<header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1"> <span class="sr-only">Menu</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> <a href="./" class="navbar-brand">Vende Todo</a> </div>
                    <div class="collapse navbar-collapse" id="navbar-1">
                        <ul class="nav navbar-nav">
                            <li class="dropdown"> <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
									Categorias <span class="caret"></span>
								</a>
                                <?php get_Categorias_nav();?>
                            </li>
                            <li><a href="">Favoritos</a></li>
                        </ul>
                        <?php if(isset($_SESSION['id'])){?>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                        <?php echo $_SESSION['nombre'];?> <span class="caret"></span> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="./perfil.php?id=<?php echo $_SESSION['id'];?>">Mi Perfil</a></li>
                                        <li><a href="./publicar.php">Publicar</a></li>
                                        <li><a href="./opciones.php">Opciones</a></li>
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
	
	<?php
            if(!empty($query) && $resultado->num_rows>0 )
            {   
                
                
                $row = $resultado->fetch_object() ;
                
                $sqlProductos = "SELECT * from producto where id_categoria=$row->id_categoria and id NOT LIKE $row->id LIMIT 2";
                $productos = $mysqli->query($sqlProductos);
                echo "<div class='container'>";
                echo "<div class='row'>";
                echo "<div class='col-md-4'>";
                //
                //se visualiza el nombre del producto.
                //
                echo "<h2>$row->nombre</h2>";
                //
                //se visualiza la imagen del producto.
                //
                echo "<img src=\"./get_img_producto.php?id=$row->id\" class='img-rounded' height='325' width='370'>";
                echo "<div class='col-md-4'>";
                echo "<table class='table'>";
                echo "<tr>
                        <th>Precio</th>
                        <th>Transacción</th>
                    </tr>";
                echo "<tr>
                        <th>$row->precio</th>
                        <th>$row->tipo_publicacion </th>
                    </tr>";
                echo "</table>";
                echo "</div>";
                echo "<div class='clearfix visible-lg-block'></div>";
                echo "</div>";
              
                //
                //Cosas para rellenar.
                //
                echo "<div class='col-md-4'>";
                echo "<h3>Caracteristicas</h3>";
                echo "<p>$row->descripcion</p>";
                echo "<button type='button' class='btn btn-success'><a id='a_VU' href='producto.php?id=$row->id&Idn2=2'>Contactar Usuario</a></button>";
                echo "</div>";
                echo "<div class='col-md-4'>";
                echo "<h3>Recomendaciones</h3>";
                ?>
                <div>
                  <br/>
                  <h6 class="text-uppercase text-muted">Algunos productos relacionados.</h6>
                  <hr/>
                  <?php
                  while ($rowP = $productos->fetch_object()){
                       echo '<div class="thumbnail">
                         <img src="./get_img_producto.php?id='.$rowP->id.'"  alt="...">
                         <div class="caption">
                           <h4>'.$rowP->nombre.'</h4>
                           <p>'.$rowP->tipo_publicacion.' | Precio'.$rowP->precio.'</p>
                           <p><a href="producto.php?id='.$rowP->id.'" class="btn btn-primary btn-xs" role="button">Ver producto</a></p>
                         </div>
                       </div>';
                  }
                  ?>
                </div>
                <?php 
                echo "</div>";
               
                
               
            }
        else 
        {
            echo   "<div class=\"alert alert-warning\">
                          <a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                          <strong>Error, No se encontro resultado.</strong>
                        </div>";
        }
		if (!empty($_GET["Idn2"]))
        {	
            if ($Idn2=$_GET["Idn2"]==2){
                $id_uno=$_GET["id"];
                $cons2="select u.nombre,u.email,c.nombre from usuario u inner join producto p on(u.id=p.id_usuario) inner join comuna c on(p.id_comuna=c.id) where p.id=".$id_uno;
                $Q = $mysqli->query($cons2);
                $Q1 = mysqli_fetch_array($Q);
                echo "<div class='container'>
                <table id='TablaVendedor'>
                <tr>
                <td>Vendedor:</td>
                <td>".$Q1[0]."</td>
                </tr>
                <tr>
                <td>Correo:</td>
                <td>".$Q1[1]."</td>
                </tr>
                <tr>
                <td>Comuna:</td>
                <td>".$Q1[2]."</td>
                </tr>
                </table>
                </div>";
            }
        }   
    
	?>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
