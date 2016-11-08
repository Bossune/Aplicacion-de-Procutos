<?php
  require './config/db.php';
  session_start();
  if(isset($_SESSION['id'])){
    header('Location: ./');
    exit();
  }
  $categorias = $mysqli->query("SELECT * FROM categoria");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vende Todo - Ingreso</title>
	  <link rel="stylesheet" href="./assets/css/bootstrap.min.css" >
	  <link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">
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
            <a href="#" class="navbar-brand">Vende Todo</a>
          </div>
          <div class="collapse navbar-collapse" id="navbar-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">
                Categorias <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <?php
                  while ($rowC = $categorias->fetch_assoc()) { ?>
                  <li><a href="./Busqueda.php?categorias=<?php echo $rowC['id'];?>"><?php echo $rowC['nombre_categoria'];?></a></li>
                  <?php } ?>
                </ul>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="./login.php" class="text-info"> Iniciar Sesión </a></li>
              <li><a href="./signup.php" class="text-info"> Registraté </a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  	<div class="container" style="margin-top: 75px">
  			<div class="col-md-4 col-md-offset-4">
          <div class="panel panel-default">
            <h5 class="text-uppercase text-center" style="padding-top: 10px">Ingreso</h5>
            <hr/>
            <div class="panel-body">
              <div id="resultado">

              </div>
              <div class="form-group">
                <input type="email" class="form-control" id="user" placeholder="Ingrese su email...">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="pass" placeholder="Ingrese su contraseña...">
              </div>
              <div class="form-group">
                <a href="#" class="btn btn-sm btn-block btn-primary" onclick="enviarDatosLogin()">Iniciar Sesión</a>
              </div>
            </div>
          </div>
  			</div>
  	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/login.js"></script>
  </body>
</html>
