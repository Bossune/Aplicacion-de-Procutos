<?php
require './config/db.php';
require './funciones.php';
session_start();


if(!empty($_GET['producto']))
{
    $query= "SELECT producto.* , region.nombre_region FROM producto INNER JOIN comuna ON producto.id_comuna = comuna.id INNER JOIN provincia ON comuna.id_provincia = provincia.id INNER JOIN region ON provincia.id_region = region.id where producto.nombre like '%".$_GET['producto']."%'";
    if(!empty($_GET['precio']))
    {
        $query .= " and precio < ".$_GET['precio']."";
    }

    if(!empty($_GET['Categorias']))
    {
        $query .= " and id_categoria in(".implode(",",$_GET['Categorias']).")";

    }

    if(!empty($_GET['region']))
    {
        $query .= " and region.id =".$_GET['region'];

    }


    $resultado= $mysqli->query($query);
}
elseif (!empty($_GET['categorias']))
{

    $query= "SELECT producto.* , region.nombre_region FROM producto INNER JOIN comuna ON producto.id_comuna = comuna.id INNER JOIN provincia ON comuna.id_provincia = provincia.id INNER JOIN region ON provincia.id_region = region.id where  producto.id_categoria =".$_GET['categorias'];

    if(!empty($_GET['precio']))
    {
        $query .= " and precio < ".$_GET['precio']."";
    }
    if (!empty($_GET['region']))
    {
        $query .=  " and region.id =".$_GET['region'];
    }

    $resultado= $mysqli->query($query);

}

elseif (!empty($_GET['Categorias']))
{

    $query= "SELECT producto.* , region.nombre_region FROM producto INNER JOIN comuna ON producto.id_comuna = comuna.id INNER JOIN provincia ON comuna.id_provincia = provincia.id INNER JOIN region ON provincia.id_region = region.id where  id_categoria in(".implode(",",$_GET['Categorias']).")";

    if(!empty($_GET['precio']))
    {
        $query .= " and precio < ".$_GET['precio']."";
    }
    if (!empty($_GET['region']))
    {
        $query .=  " and region.id =".$_GET['region'];
    }

    $resultado= $mysqli->query($query);

}
elseif(!empty($_GET['region']))
{
    $query= "SELECT producto.* , region.nombre_region FROM producto INNER JOIN comuna ON producto.id_comuna = comuna.id INNER JOIN provincia ON comuna.id_provincia = provincia.id INNER JOIN region ON provincia.id_region = region.id  where region.id =".$_GET['region'];

    if(!empty($_GET['precio']))
    {
        $query .= " and precio < ".$_GET['precio']."";
    }
    if(!empty($_GET['Categorias']))
    {
        $query .= " and id_categoria in(".implode(",",$_GET['Categorias']).")";

    }

    $resultado= $mysqli->query($query);
}

else
{
    $query= "SELECT producto.* , region.nombre_region FROM producto INNER JOIN comuna ON producto.id_comuna = comuna.id INNER JOIN provincia ON comuna.id_provincia = provincia.id INNER JOIN region ON provincia.id_region = region.id";
    $resultado= $mysqli->query($query);
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
        <link rel="stylesheet" href="assets/css/simple-sidebar.css">
        <script src="./assets/js/jquery-3.1.1.min.js"></script>
        <script src="assets/js/barra_lateral.js"></script>
    </head>
    <body>
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
						<a href="./" class="navbar-brand">Vende Todo</a>
					</div>

					<div class="collapse navbar-collapse" id="navbar-1">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
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
                  <?php echo $_SESSION['nombre'];?> <span class="caret"></span>
                </a>
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
        <div class="container">
            <div class="row">
               <div id="sidebar-wrapper" >
                    <ul class="sidebar-nav">
                        <form method="get" action="./Busqueda.php">

                            <li>
                                Busqueda:
                            </li>
                            <li>
                                <input  class="form-control"  type="text"  placeholder="Ex:Motorola" name="producto">
                            </li>
                            <br>
                            <li>
                                Precio:
                            </li>
                            <li>
                                  <input  class="form-control"  type="number"  placeholder="0" name="precio" id="precio">
                            </li>
                            <br>

                            <li>
                                <input  id="slider_precio" type="range"  step="1000" min=0  max="10000000" >
                            </li>
                            <br>
                            <li> <button type="submit" >Buscar</button></li>
                            <br>
                            <li >
                                <?php get_Regiones()?>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categorias <b class="caret"></b> </a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php get_Categorias()?>
                                </ul>
                            </li>


                        </form>
                    </ul>
                </div>
            <div class="class=col-xs-10 col-xs-offset-1">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Producto</th>
                        <th>Categoria</th>
                        <th>Region</th>
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
                                    <td><img id=\"image\" class=\"img-responsive\" style=\"width:150px;height:150px;\" src=\"./get_img_producto.php?id=$row->id\"/></td>
                                    <td>$row->nombre</td>
                                    <td>$row->id_categoria</td>
                                    <td>$row->nombre_region</td>
                                    <td>$row->precio</td>
                                    <td><a href=\"./producto.php?id=$row->id\"><button>Link</button></a></td>
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
        </div>
       </div>
        	<script src="./assets/js/bootstrap.min.js"></script>
    </body>

</html>
