<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Vende Todo - Perfil</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="./assets/css/bootstrap.min.css" >

	<!-- Optional theme -->
	<link rel="stylesheet" href="./assets/css/bootstrap-theme.min.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="./assets/js/bootstrap.min.js"></script>

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
                  <li><a href="">Computadores y electronica</a></li>
                  <li><a href="">Hogar</a></li>
                  <li><a href="">Tiempo libre</a></li>
                  <li><a href="">Vehiculos</a></li>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
		<script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/login.js"></script>
  </body>
</html>
